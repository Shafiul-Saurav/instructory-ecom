<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentStoreRequest;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $comments = Comment::with('user', 'post')->latest('id')->where('is_approved', 1)
    //     ->select(['id', 'user_id', 'post_id', 'commentor_comment'])
    //     ->paginate(5);
    //     return view('frontend.pages.single_post', compact('comments'));
    // }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentStoreRequest $request)
    {
        // dd($request->all());
        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_slug,
            'commentor_comment' => $request->commentor_comment
        ]);

        Toastr::success('Comment Published Successfully!');
        return redirect()->back();
    }
}
