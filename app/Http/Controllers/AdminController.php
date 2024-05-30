<?php

namespace App\Http\Controllers;

use App\Http\Models\Bookmark;
use App\Http\Models\Favorite;
use App\Http\Models\User;
use App\Http\Models\Play;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function getStatInfo()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Check if authenticated user is an admin
        $user = Auth::user();
        if ($user->is_admin !== 1) {
            return response()->json(['error' => 'Forbidden'], 403);
        }


        $userCount = User::count();
        $totalBookmarks = Bookmark::count();
        $totalFavotites = Favorite::count();
        $totalClicks = Play::count();
        $clicksPerMonth = Play::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as clicks')
            ->groupBy('year', 'month')
            ->get();

        return response()->json([
            'userCount' => $userCount,
            'totalBookmarks' => $totalBookmarks,
            'totalFavotites' => $totalFavotites,
            'totalClicks' => $totalClicks,
            'clicksPerMonth'=> $clicksPerMonth
        ]);
    }
}
