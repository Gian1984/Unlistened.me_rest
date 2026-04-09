<?php
namespace App\Http\Controllers;

use App\MusicFavorite;
use Illuminate\Http\Request;

class MusicFavoriteController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            MusicFavorite::where('user_id', $request->user()->id)
                ->orderBy('created_at', 'desc')
                ->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'jamendo_track_id' => 'required|string',
            'title'            => 'required|string',
            'artist_name'      => 'required|string',
            'artist_id'        => 'required|string',
            'audio_url'        => 'required|string',
        ]);

        $favorite = MusicFavorite::firstOrCreate(
            ['user_id' => $request->user()->id, 'jamendo_track_id' => $request->jamendo_track_id],
            $request->only(['title', 'artist_name', 'artist_id', 'album_name', 'album_image', 'audio_url', 'duration', 'license_ccurl', 'shareurl'])
        );

        return response()->json($favorite, 201);
    }

    public function destroy(Request $request, string $trackId)
    {
        MusicFavorite::where('user_id', $request->user()->id)
            ->where('jamendo_track_id', $trackId)
            ->delete();

        return response()->json(['message' => 'Removed from favorites']);
    }

    public function check(Request $request, string $trackId)
    {
        $exists = MusicFavorite::where('user_id', $request->user()->id)
            ->where('jamendo_track_id', $trackId)
            ->exists();

        return response()->json(['favorited' => $exists]);
    }
}
