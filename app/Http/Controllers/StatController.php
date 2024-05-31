<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Play;

class StatController extends Controller
{
    public function addPlayClick(Request $request)
    {
        $request->validate([
            'episode_id' => 'required',
            'episode_title' =>'required'
        ]);

        $play = Play::create([
            'episode_id' => $request->episode_id,
            'episode_title' => $request->episode_title,
        ]);

        return response()->json($play, 201);
    }
}
