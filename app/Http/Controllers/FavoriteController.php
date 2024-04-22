<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Podcast;
use App\Models\User;

class FavoriteController extends Controller
{

    public function index()
    {
        return response()->json(Favorite::all(),200);
    }

    public function store(Request $request) {
        $request->validate([
            'podcast_id' => 'required',
        ]);

        $favorite = Favorite::create([
            'user_id' => auth()->id(),
            'podcast_id'=> $request->podcast_id,
            'title' => $request->title,
        ]);

        return response()->json([
            'status' => (bool) $favorite,
            'data'   => $favorite,
            'message' => $favorite ? 'Favorite Created!' : 'Error Creating Favorite'
        ]);
    }
}
