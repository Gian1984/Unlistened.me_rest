<?php

namespace App\Http\Controllers;

use App\Http\Models\Bookmark;
use App\Http\Models\Favorite;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::with(['orders'])->get());
    }

    public function log(Request $request)
    {

        // Your existing logic
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

    public function logout()
    {
        {
            Auth::logout();
            return response()->json(['message' => 'Successfully logged out']);
        }

    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
            'preferred_language'=> 'nullable|string|max:5',
        ]);


        if ($validator->fails()) {
            return response()->json( $validator->errors(), 401);
        }

        $data = $request->only(['name','email','password']);
        $data['password'] = bcrypt($data['password']);

        // Check if the user with the email exists in the trashed users
        $user = User::withTrashed()->where('email', $data['email'])->first();

        if ($user) {
            // Restore the user
            $user->restore();
            $user->update(['name' => $data['name'], 'password' => $data['password']]);
        } else {
            // Create new user
            $user = User::create($data);
            $user->is_admin = 0;
        }

        Mail::send('email.welcomeMessage', ['user' =>  $user], function($message) use( $user){
            $message->to($user->email);
            $message->subject('Welcome to Unlistened.me');
        });

        $token = $user->createToken('bigStore')->accessToken;

        return response()->json(['token'=>$token],200);

    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function updateUser(Request $request, User $user)
    {
        $user = Auth::user();

        $rules = [];
        if ($request->has('name')) {
            $rules['name'] = 'required|string|max:255|unique:users,name,' . $user->id;
        }
        if ($request->has('email')) {
            $rules['email'] = 'required|string|email|max:255|unique:users,email,' . $user->id;
        }
        if ($request->has('preferred_language')) {
            $rules['preferred_language'] = 'string|max:5' . $user->id;
        }

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update the user's information
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email')) {
            $user->email = $request->email;
        }
        if ($request->has('preferred_language')) {
            $user->preferred_language = $request->preferred_language;
        }

        $user->save();

        return response()->json(['message' => 'User updated successfully']);

    }

    public function languageUser(Request $request, User $user)
    {
        $user = Auth::user();

        $rules = [];

        if ($request->has('preferred_language')) {
            $rules['preferred_language'] = 'string|max:5' . $user->id;
        }

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update the user's information
        if ($request->has('preferred_language')) {
            $user->preferred_language = $request->preferred_language;
        }

        $user->save();

        return response()->json(['message' => 'Language updated successfully']);

    }

    public function updateAdminStatus(Request $request)
    {
        $id = $request->user_id;

        if ($id == 1 || $id == 2 || $id == 3) {
            return response()->json(['error' => 'This user cannot be modify'], 403);
        }

        $user = User::find($request->user_id);

        if ($user) {
            $user->is_admin = $request->is_admin;
            $user->save();

            return response()->json([
                'is_admin' => $user->is_admin,
                'message' => 'Successfully update role!'
            ], 200);
        }

        return response()->json(['error' => 'User not found'], 404);
    }

    public function destroy($id)
    {

        if ($id == 1 || $id == 2 || $id == 3) {
            return response()->json(['error' => 'This user cannot be deleted'], 403);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        Mail::send('email.deleteAccount', ['user' =>  $user], function($message) use( $user){
            $message->to($user->email);
            $message->subject('Goodbye from Unlistened.me');
        });

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
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
            'feed_id' => 'required|integer',
        ]);

        $userId = auth()->id();;  // Get the authenticated user's ID
        $feedId = $request->feed_id;

        // Find the favorite in the database
        $favorite = Favorite::where('user_id', $userId)
            ->where('feed_id', $feedId)
            ->first();

        if (!$favorite) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

        // Delete the favorite
        $favorite->delete();

        return response()->json(['message' => 'Feed successfully deleted']);
    }

    public function getBookmarks()
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        // Fetch all favorite records where user_id matches the given $userId
        $bookmarks = Bookmark::where('user_id', $userId)->get();

        if ($bookmarks->isEmpty()) {
            return response()->json(['message' => 'No favorites found for this user'], 404);
        }

        return response()->json($bookmarks);
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

    public function loginMobile(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $status = 401;
        $response = ['error' => 'Wrong password or user name please try again.'];

        if (Auth::attempt($request->only(['email', 'password']))) {
            $status = 200;
            $user = Auth::user();
            $token = $user->createToken($request->device_name)->plainTextToken;
            $response = [
                'user' => $user,
                'check' => Auth::check(),
                'token' => $token, // This is now a plain string
            ];
        }

        return response()->json($response, $status);
    }

}
