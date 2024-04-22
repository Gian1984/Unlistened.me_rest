<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::with(['orders'])->get());
    }

    public function login(Request $request)
    {
        $status = 401;
        $response = ['error' => 'Wrong password or user name please try again.'];

        if (Auth::attempt($request->only(['email', 'password']))) {
            $status = 200;
            $response = [
                'user' => Auth::user(),
                'check' => Auth::check(),
                'token' => Auth::user()->createToken('bigStore')->accessToken,
            ];
        }

        return response()->json($response, $status);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],

        ]);

        if ($validator->fails()) {
            return response()->json( $validator->errors(), 401);
        }

        $data = $request->only(['name','email', 'password']);
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        $user->is_admin = 0;

        $token = $user->createToken('bigStore')->accessToken;

        return response()->json(['token'=>$token],200);

    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {


        $status = $user->update(
            $request->only(
                [
                    'name',
                    'email',
                ]
            )
        );

        $user->where('id', $user->id)->update(array('is_admin' => $request->admin));


        return response()->json([
            'status' => $status,
            'message' => $status ? 'User Updated!' : 'Error Updating User'
        ]);
    }

    public function destroy($id)
    {
        return User::findOrFail($id)->delete();
    }

    public function getFavorites()
    {
        $userId = auth()->id(); // Securely getting the authenticated user's ID

        if (!$userId) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        // Fetch all favorite records where user_id matches the given $userId
        $favorites = Favorite::where('user_id', $userId)->get();

        if ($favorites->isEmpty()) {
            return response()->json(['message' => 'No favorites found for this user'], 404);
        }

        return response()->json($favorites);
    }

    public function destroyFavorite(Request $request)
    {
        $request->validate([
            'podcast_id' => 'required|integer',
        ]);

        $userId = auth()->id();;  // Get the authenticated user's ID
        $podcastId = $request->podcast_id;

        // Find the favorite in the database
        $favorite = Favorite::where('user_id', $userId)
            ->where('podcast_id', $podcastId)
            ->first();

        if (!$favorite) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

        // Delete the favorite
        $favorite->delete();

        return response()->json(['message' => 'Favorite successfully deleted']);
    }

    public function getBookmarks()
    {
        $userId = auth()->id(); // Securely getting the authenticated user's ID

        if (!$userId) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        // Fetch all favorite records where user_id matches the given $userId
        $favorites = Bookmark::where('user_id', $userId)->get();

        if ($favorites->isEmpty()) {
            return response()->json(['message' => 'No favorites found for this user'], 404);
        }

        return response()->json($favorites);
    }

    public function destroyBookmark(Request $request)
    {
        $request->validate([
            'episode_id' => 'required|integer',
        ]);

        $userId = auth()->id();;  // Get the authenticated user's ID
        $podcastId = $request->episode_id;

        // Find the favorite in the database
        $favorite = Bookmark::where('user_id', $userId)
            ->where('episode_id', $podcastId)
            ->first();

        if (!$favorite) {
            return response()->json(['message' => 'Episode not found'], 404);
        }

        // Delete the favorite
        $favorite->delete();

        return response()->json(['message' => 'Episode successfully deleted']);
    }
}
