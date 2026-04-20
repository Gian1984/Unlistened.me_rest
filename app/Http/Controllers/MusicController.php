<?php

namespace App\Http\Controllers;

use App\Services\JamendoService;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function __construct(private JamendoService $jamendo) {}

    public function trending(Request $request)
    {
        $tags   = $request->query('genre', '');
        $limit  = (int) $request->query('limit', 20);
        $offset = (int) $request->query('offset', 0);

        return response()->json($this->jamendo->getTrendingTracks($tags, $limit, $offset));
    }

    public function search(Request $request)
    {
        $q      = $request->query('q', '');
        $genre  = $request->query('genre', '');
        $offset = (int) $request->query('offset', 0);

        $data = $genre
            ? $this->jamendo->searchByGenre($genre, 20, $offset)
            : $this->jamendo->search($q, 20, $offset);

        return response()->json($data);
    }

    public function albums(Request $request)
    {
        $q      = $request->query('q', '');
        $artist = $request->query('artist', '');
        $offset = (int) $request->query('offset', 0);
        $limit  = (int) $request->query('limit', 20);
        $order  = $request->query('order', 'popularity_week');
        $type   = $request->query('type', '');

        return response()->json(
            $this->jamendo->getAlbums($q, $limit, $offset, $artist, $order, $type)
        );
    }

    public function track(string $id)
    {
        return response()->json($this->jamendo->getTrack($id));
    }

    public function album(string $id)
    {
        $albumWithTracks = $this->jamendo->getAlbumWithTracks($id);
        $results = $albumWithTracks['results'] ?? [];

        if (!empty($results)) {
            return response()->json($albumWithTracks);
        }

        return response()->json($this->jamendo->getAlbum($id));
    }

    public function artist(string $id)
    {
        return response()->json($this->jamendo->getArtist($id));
    }

    public function radios()
    {
        return response()->json($this->jamendo->getRadios());
    }

    public function similar(string $id)
    {
        return response()->json($this->jamendo->getSimilar($id));
    }
}
