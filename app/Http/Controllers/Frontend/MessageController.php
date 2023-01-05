<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MessageStoreRequest;

class MessageController extends Controller
{
    public function create()
    {
        // $user = User::select('id', 'name', 'email')->get();
        return view('frontend.pages.contact');
    }

    public function store(MessageStoreRequest $request)
    {
        // dd($request->all());
        $message = Message::create([
            'user_id' => Auth::user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        Toastr::success('Message Sent Successfully!');
        return redirect()->back();
    }
}
