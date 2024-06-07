<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Faq;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        // Check if the authenticated user is an admin
        if ($user->is_admin === 0) {
            return response()->json(['message' => 'Forbidden: Only admins can access this resource'], 403);
        }


        return response()->json(Faq::all(),200);
    }

    public function newFaq(Request $request)
    {
        $faq = Faq::create([
            'user_id' => auth()->id(),
            'username'=> auth()->user()->name,
            'email'=> auth()->user()->email,
            'message_obj'=> $request->message_obj,
            'message_desc'=> $request->message_desc,
        ]);

        $success = $request;

        Mail::send('email.faqRequest', ['success' => $success], function ($message) use ($request) {
            $message->to(auth()->user()->email);
            $message->to('support@unlistened.me');

            $message->subject('New question from Unlistened.me');
        });

        return response()->json([
            'status' => (bool) $faq,
            'data'   => $faq,
            'message' => $faq ? 'Your question was sent correctly!' : 'Error while sending. Please try later.'
        ]);
    }

    public function updateFaqStatus(Request $request)
    {
        $faq = Faq::find($request->faq_id);
        if ($faq) {
            $faq->was_answered = $request->was_answered;
            $faq->save();

            return response()->json([
                'was_answered' => $faq->was_answered,
                'message' => 'Successfully update status!'
            ], 200);
        }

        return response()->json(['error' => 'Faq not found'], 404);
    }

    public function destroy($id)
    {
        $faq = Faq::find($id);

        if ($faq) {
            $faq->delete();

            return response()->json([
                'message' => 'Successfully deleted!'
            ], 200);
        }

        return response()->json(['error' => 'Faq not found'], 404);
    }
}
