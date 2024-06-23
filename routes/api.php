<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LanguageController;


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/update_user', [UserController::class, 'updateUser']);
Route::post('/update-status', [UserController::class, 'updateAdminStatus']);
Route::delete('/delete_users/{id}', [UserController::class, 'destroy']);

Route::post('forgot-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']);
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm']);

Route::post('/add-favorite', [FavoriteController::class, 'store']);
Route::post('/favorites/{id}/update-section', [FavoriteController::class, 'updateSectionFavs']);
Route::get('/user-favorites', [UserController::class, 'getFavorites']);
Route::post('/delete-favorite', [UserController::class, 'destroyFavorite']);

Route::post('/detect-language', [LanguageController::class, 'detectLanguage']);

Route::post('/add-bookmark', [BookmarkController::class, 'store']);
Route::post('/bookmarks/{id}/update-section', [BookmarkController::class, 'updateSectionBook']);
Route::get('/user-bookmarks', [UserController::class, 'getBookmarks']);
Route::post('/delete-bookmark', [UserController::class, 'destroyBookmark']);

Route::post('/add_play_click', [StatController::class, 'addPlayClick']);
Route::post('/add_download_click', [StatController::class, 'addDownloadClick']);

Route::get('/get_stats', [AdminController::class, 'getStatInfo']);
Route::get('/users', [AdminController::class, 'getAllUsers']);

Route::post('/new-faq', [FaqController::class, 'newFaq']);
Route::get('/faqs', [FaqController::class, 'index']);
Route::post('/update-faq-status', [FaqController::class, 'updateFaqStatus']);
Route::delete('/delete_faq/{id}', [FaqController::class, 'destroy']);

Route::get('/index', [ApiController::class, 'index']);
Route::get('/search_feed/{id}', [ApiController::class, 'searchFeed']);
Route::get('/feed_info/{id}', [ApiController::class, 'feedInfo']);
Route::get('/search-feed-by-title/{title}', [ApiController::class, 'searchFeedByTitle']);
Route::get('/feed-cat', [ApiController::class, 'getFeedCategory']);
Route::get('/search-feeds-by-cat/{cat}', [ApiController::class, 'searchFeedsByCategory']);
Route::get('/search_episode/{id}', [ApiController::class, 'searchPodcastEpisode']);



