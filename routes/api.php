<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\FaqController;

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/update_user', [UserController::class, 'updateUser']);
Route::delete('/delete_users/{id}', [UserController::class, 'destroy']);

Route::post('forgot-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']);
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm']);

Route::post('/add-favorite', [FavoriteController::class, 'store']);
Route::get('/user-favorites', [UserController::class, 'getFavorites']);
Route::post('/delete-favorite', [UserController::class, 'destroyFavorite']);

Route::post('/add-bookmark', [BookmarkController::class, 'store']);
Route::get('/user-bookmarks', [UserController::class, 'getBookmarks']);
Route::post('/delete-bookmark', [UserController::class, 'destroyBookmark']);

Route::post('/new-faq', [FaqController::class, 'newFaq']);

Route::get('/index', [ApiController::class, 'index']);
Route::get('/search_feed/{id}', [ApiController::class, 'searchFeed']);
Route::get('/feed_info/{id}', [ApiController::class, 'feedInfo']);
Route::get('/search-podcast/{title}', [ApiController::class, 'searchPod']);
Route::get('/search_episode/{id}', [ApiController::class, 'searchPodcastEpisode']);



