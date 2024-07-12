<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;



class ApiController extends Controller
{

    public function index(Request $request)
    {
        // Required values
        $apiKey = config('services.podcastindex.api_key');
        $apiSecret = config('services.podcastindex.api_secret');
        $apiHeaderTime = time();

        // Attempt to get the authenticated user via Sanctum token
        $user = Auth::user();

        // If Auth::user() is null, manually check for Bearer token and authenticate
        if (!$user && $request->bearerToken()) {
            $token = $request->bearerToken();
            $user = \Laravel\Sanctum\PersonalAccessToken::findToken($token)?->tokenable;
        }

        if ($user) {
            // Get the user's preferred language from their profile
            $preferredLanguage = $user->preferred_language; // Assuming 'preferred_language' is a column in the users table
        } else {
            // For unauthenticated users, detect language from the request
            $languageController = new LanguageController();
            $languageResponse = $languageController->detectLanguage($request);
            $preferredLanguage = $languageResponse->getData()->language;
        }

        // Hash them to get the Authorization token
        $hash = sha1($apiKey . $apiSecret . $apiHeaderTime);

        // Make the request to the API endpoint
        $response = Http::withHeaders([
            "User-Agent" => "podplayer2",
            "X-Auth-Key" => $apiKey,
            "X-Auth-Date" => $apiHeaderTime,
            "Authorization" => $hash
        ])->get('https://api.podcastindex.org/api/1.0/podcasts/trending', [
            'since' => 953501165,
            'max' => 100,
            'lang' => $preferredLanguage
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
            'max' => 100,
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

    public function searchFeedsByCategory(Request $request, $id)
    {
        // Required values
        $apiKey = config('services.podcastindex.api_key');
        $apiSecret = config('services.podcastindex.api_secret');
        $apiHeaderTime = time();

        // Hash them to get the Authorization token
        $hash = sha1($apiKey.$apiSecret.$apiHeaderTime);

        $user = Auth::user();

        // If Auth::user() is null, manually check for Bearer token and authenticate
        if (!$user && $request->bearerToken()) {
            $token = $request->bearerToken();
            $user = \Laravel\Sanctum\PersonalAccessToken::findToken($token)?->tokenable;
        }

        if ($user) {
            // Get the user's preferred language from their profile
            $preferredLanguage = $user->preferred_language; // Assuming 'preferred_language' is a column in the users table
        } else {
            // For unauthenticated users, detect language from the request
            $languageController = new LanguageController();
            $languageResponse = $languageController->detectLanguage($request);
            $preferredLanguage = $languageResponse->getData()->language;
        }

        // Make the request to an API endpoint
        $response = Http::withHeaders([
            "User-Agent" => "podplayer2",
            "X-Auth-Key" => $apiKey,
            "X-Auth-Date" => $apiHeaderTime,
            "Authorization" => $hash
        ])->get('https://api.podcastindex.org/api/1.0/recent/feeds', [
            'max' => 100,
            'cat' => $id,
            'lang'=>$preferredLanguage
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
