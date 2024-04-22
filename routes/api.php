<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\BookmarkController;

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::post('/add-favorite', [FavoriteController::class, 'store']);
Route::get('/user-favorites', [UserController::class, 'getFavorites']);
Route::post('/delete-favorite', [UserController::class, 'destroyFavorite']);

Route::post('/add-bookmark', [BookmarkController::class, 'store']);
Route::get('/user-bookmarks', [UserController::class, 'getBookmarks']);
Route::post('/delete-bookmark', [UserController::class, 'destroyBookmark']);

Route::get('/index', [ApiController::class, 'index']);
Route::get('/podcast_episodes/{id}', [ApiController::class, 'podcastEpisodes']);
Route::get('/podcast_info/{id}', [ApiController::class, 'podcastInfo']);
Route::get('/search-podcast/{title}', [ApiController::class, 'searchPod']);



