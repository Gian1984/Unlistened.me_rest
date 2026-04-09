<?php
namespace App\Http\Controllers;

use App\Services\JamendoService;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function __construct(private JamendoService $jamendo) {}

    public function trending(Request $request)
    {
        $tags  = $request->query('genre', '');
        $limit = (int) $request->query('limit', 20);
        return response()->json($this->jamendo->getTrending($limit, $tags));
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

    public function track(string $id)
    {
        return response()->json($this->jamendo->getTrack($id));
    }

    public function album(string $id)
    {
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
