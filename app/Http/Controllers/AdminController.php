<?php

namespace App\Http\Controllers;

use App\Http\Models\Bookmark;
use App\Http\Models\Download;
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
        $deletedAccountsCount = User::onlyTrashed()->count();
        $totalBookmarks = Bookmark::count();
        $totalFavotites = Favorite::count();
        $totalPlay = Play::count();
        $clicksPlayPerMonth = Play::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as clicks')
            ->groupBy('year', 'month')
            ->get();
        $totalDownload = Download::count();
        $clicksDownloadPerMonth = Download::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as clicks')
            ->groupBy('year', 'month')
            ->get();

        return response()->json([
            'Account active' => $userCount,
            'Deleted accounts' => $deletedAccountsCount,
            'Total bookmarks' => $totalBookmarks,
            'Total Favotites' => $totalFavotites,
            'Podcasts listened' => $totalPlay,
            'Podcasts listened per month'=> $clicksPlayPerMonth,
            'Podcasts downloaded' => $totalDownload,
            'Podcasts downloaded per month'=> $clicksDownloadPerMonth,
        ]);
    }
}
