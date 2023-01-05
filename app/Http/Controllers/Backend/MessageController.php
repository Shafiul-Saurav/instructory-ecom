<?php

namespace App\Http\Controllers\backend;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest('id')->with(['user'])
        ->select(['id', 'user_id', 'subject', 'message', 'created_at'])->paginate();
        return view('backend.pages.message.index', compact('messages'));
    }

    public function delete($id)
    {
        // dd($id);
        $message = Message::where('id', $id)->first();
        $message->delete();

        Toastr::success('Message Deleted Successfully!');
        return redirect()->back();
    }
}
