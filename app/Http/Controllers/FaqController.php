<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Faq;
use Illuminate\Support\Facades\Mail;

class FaqController extends Controller
{
    public function index()
    {
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
            $message->to('faq@unlistened.me');

            $message->subject('New question from Unlistened.me');
        });

        return response()->json([
            'status' => (bool) $faq,
            'data'   => $faq,
            'message' => $faq ? 'Faq created!' : 'Error creating faq'
        ]);
    }
}
