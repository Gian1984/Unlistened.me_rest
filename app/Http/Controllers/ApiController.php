<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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

    public function searchFeedByTitle($title)
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
        ]);

        // Return the response body
        return $response->body();
    }


    public function getFeedCategory()
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
        ])->get('https://api.podcastindex.org/api/1.0/categories/list');

        // Return the response body
        return $response->body();
    }

    public function searchFeedsByCategory($id)
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
        ])->get('https://api.podcastindex.org/api/1.0/recent/feeds', [
            'max' => 20,
            'cat' => $id,
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
