<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class JamendoService
{
    private string $baseUrl = 'https://api.jamendo.com/v3.0';
    private string $clientId;

    public function __construct()
    {
        $this->clientId = config('services.jamendo.client_id');
    }

    private function get(string $endpoint, array $params = []): array
    {
        $response = Http::get("{$this->baseUrl}/{$endpoint}", array_merge([
            'client_id'   => $this->clientId,
            'format'      => 'json',
            'audioformat' => 'mp32',
        ], $params));

        return $response->json() ?? [];
    }

    public function getTrendingTracks(string $genre = '', int $limit = 20, int $offset = 0): array
    {
        return $this->get('tracks', [
            'order'       => 'popularity_week',
            'tags'        => $genre,
            'limit'       => $limit,
            'offset'      => $offset,
            'include'     => 'musicinfo',
            'audioformat' => 'mp32',
        ]);
    }

    public function search(string $query, int $limit = 20, int $offset = 0): array
    {
        return $this->get('tracks', [
            'namesearch' => $query,
            'limit'      => $limit,
            'offset'     => $offset,
            'include'    => 'musicinfo',
        ]);
    }

    public function searchByGenre(string $tags, int $limit = 20, int $offset = 0): array
    {
        return $this->get('tracks', [
            'tags'    => $tags,
            'order'   => 'popularity_week',
            'limit'   => $limit,
            'offset'  => $offset,
            'include' => 'musicinfo',
        ]);
    }

    public function getAlbums(
        string $query = '',
        int $limit = 20,
        int $offset = 0,
        string $artist = '',
        string $order = 'popularity_week',
        string $type = ''
    ): array {
        return $this->get('albums', array_filter([
            'namesearch'  => $query,
            'artist_name' => $artist,
            'limit'       => $limit,
            'offset'      => $offset,
            'order'       => $order,
            'type'        => $type,
        ]));
    }

    public function getTrack(string $id): array
    {
        return $this->get('tracks', ['id' => $id, 'include' => 'musicinfo']);
    }

    public function getAlbum(string $id): array
    {
        return $this->get('albums', ['id' => $id, 'include' => 'musicinfo']);
    }

    public function getAlbumWithTracks(string $id): array
    {
        return $this->get('albums/tracks', ['id' => $id, 'include' => 'musicinfo']);
    }

    public function getArtist(string $id): array
    {
        return $this->get('artists', ['id' => $id, 'include' => 'musicinfo']);
    }

    public function getRadios(): array
    {
        return $this->get('radios', ['type' => 'editorial']);
    }

    public function getSimilar(string $id, int $limit = 10): array
    {
        return $this->get('tracks/similar', ['id' => $id, 'limit' => $limit]);
    }
}
