<?php

namespace App\Http\Controllers\Backend;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\CommentUpdateRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with('user', 'post')->latest('id')
        ->select(['id', 'user_id', 'post_id', 'commentor_comment', 'is_active', 'is_approved', 'created_at'])
        ->paginate(20);
        return view('backend.pages.comment.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::where('id', $id)->first();
        return view('backend.pages.comment.index', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentUpdateRequest $request, $id)
    {
        // dd($request->all());
        $comment = Comment::where('id', $id)->first();
        $comment->update([
            'is_approved' => $request->filled('is_approved'),
        ]);

        Toastr::success('Comment Updated Successfully');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $comment = Comment::where('id', $id)->first();
        $comment->delete();

        Toastr::success('Comment Deleted Successfully!');
        return redirect()->back();
    }
}
