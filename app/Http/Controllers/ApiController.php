<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;



class ApiController extends Controller
{
    public function index()
    {
        // Required values
        $apiKey = config('services.podcastindex.api_key');
        $apiSecret = config('services.podcastindex.api_secret');
        $apiHeaderTime = time();

        // Hash them to get the Authorization token
        $hash = sha1($apiKey.$apiSecret.$apiHeaderTime);

        // Make the request to an API endpoint
        $response = Http::withHeaders([
            "User-Agent" => "podplayer2",
            "X-Auth-Key" => $apiKey,
            "X-Auth-Date" => $apiHeaderTime,
            "Authorization" => $hash
        ])->get('https://api.podcastindex.org/api/1.0/podcasts/trending', [
            'since' => 953501165,
            'max' => 100
        ]);

        // Return the response body
        return $response->body();

    }

    public function searchFeed($id)
    {
        // Required values
        $apiKey = config('services.podcastindex.api_key');
        $apiSecret = config('services.podcastindex.api_secret');
        $apiHeaderTime = time();

        // Hash them to get the Authorization token
        $hash = sha1($apiKey.$apiSecret.$apiHeaderTime);

        // Make the request to an API endpoint
        $response = Http::withHeaders([
            "User-Agent" => "podplayer2",
            "X-Auth-Key" => $apiKey,
            "X-Auth-Date" => $apiHeaderTime,
            "Authorization" => $hash
        ])->get('https://api.podcastindex.org/api/1.0/episodes/byfeedid', [
            'id' => $id,
        ]);

        // Return the response body
        return $response->body();
    }

    public function feedInfo($id)
    {
        // Required values
        $apiKey = config('services.podcastindex.api_key');
        $apiSecret = config('services.podcastindex.api_secret');
        $apiHeaderTime = time();

        // Hash them to get the Authorization token
        $hash = sha1($apiKey . $apiSecret . $apiHeaderTime);

        // Make the request to an API endpoint
        $response = Http::withHeaders([
            "User-Agent" => "podplayer2",
            "X-Auth-Key" => $apiKey,
            "X-Auth-Date" => $apiHeaderTime,
            "Authorization" => $hash
        ])->get('https://api.podcastindex.org/api/1.0/podcasts/byfeedid', [
            'id' => $id,
        ]);

        // Return the response body
        return $response->body();
    }

    public function searchPod($title)
    {
        // Required values
        $apiKey = config('services.podcastindex.api_key');
        $apiSecret = config('services.podcastindex.api_secret');
        $apiHeaderTime = time();

        // Hash them to get the Authorization token
        $hash = sha1($apiKey.$apiSecret.$apiHeaderTime);

        // Make the request to an API endpoint
        $response = Http::withHeaders([
            "User-Agent" => "podplayer2",
            "X-Auth-Key" => $apiKey,
            "X-Auth-Date" => $apiHeaderTime,
            "Authorization" => $hash
        ])->get('https://api.podcastindex.org/api/1.0/search/byterm', [
            'q' => $title,
            'max' => 10
        ]);

        // Return the response body
        return $response->body();
    }

    public function searchPodcastEpisode($id)
    {
        // Required values
        $apiKey = config('services.podcastindex.api_key');
        $apiSecret = config('services.podcastindex.api_secret');
        $apiHeaderTime = time();

        // Hash them to get the Authorization token
        $hash = sha1($apiKey.$apiSecret.$apiHeaderTime);

        // Make the request to an API endpoint
        $response = Http::withHeaders([
            "User-Agent" => "podplayer2",
            "X-Auth-Key" => $apiKey,
            "X-Auth-Date" => $apiHeaderTime,
            "Authorization" => $hash
        ])->get('https://api.podcastindex.org/api/1.0/episodes/byid', [
            'id' => $id,
        ]);

        // Return the response body
        return $response->body();
    }

}
