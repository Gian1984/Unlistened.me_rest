<?php

namespace App\Http\Controllers;

use App\Http\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{

    public function index()
    {
        return response()->json(Bookmark::all(),200);
    }

    public function store(Request $request) {
        $request->validate([
            'episode_id' => 'required',
        ]);

        $favorite = Bookmark::create([
            'user_id' => auth()->id(),
            'episode_id'=> $request->episode_id,
            'title' => $request->title,
        ]);

        return response()->json([
            'status' => (bool) $favorite,
            'data'   => $favorite,
            'message' => $favorite ? 'Bookmark Created!' : 'Error Creating Bookmark'
        ]);
    }

    public function updateSectionBook(Request $request, $id)
    {
        $favorite = Bookmark::findOrFail($id);
        $favorite->section = $request->section;
        $favorite->save();

        return response()->json(['message' => 'Successfully move!']);
    }
}
