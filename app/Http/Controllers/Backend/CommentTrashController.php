<?php

namespace App\Http\Controllers\Backend;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CommentTrashController extends Controller
{
    public function trash()
    {
        $comments = Comment::onlyTrashed()->with('user', 'post')->latest('id')
        ->select(['id', 'user_id', 'post_id', 'commentor_comment', 'is_active', 'is_approved', 'created_at'])
        ->paginate(20);
        return view('backend.pages.comment.trash', compact('comments'));
    }

    public function restore($id)
    {
        $comment = Comment::onlyTrashed()->where('id', $id)->first();
        $comment->restore();

        Toastr::success('Comment restored Successfully');
        return redirect()->route('post_comment.index');
    }

    public function forceDelete($id)
    {
        $comment = Comment::onlyTrashed()->where('id', $id)->first();
        $comment->forceDelete();

        Toastr::success('Coupon Has Been Deleted Permanently!');
        return redirect()->route('post_comment.index');
    }
}
