<?php

namespace App\Http\Controllers;

use App\Http\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function index()
    {
        return response()->json(Favorite::all(),200);
    }

    public function store(Request $request) {
        $request->validate([
            'feed_id' => 'required',
        ]);

        $favorite = Favorite::create([
            'user_id' => auth()->id(),
            'feed_id'=> $request->feed_id,
            'title' => $request->title,
        ]);

        return response()->json([
            'status' => (bool) $favorite,
            'data'   => $favorite,
            'message' => $favorite ? 'Favorite Created!' : 'Error Creating Favorite'
        ]);
    }
}
