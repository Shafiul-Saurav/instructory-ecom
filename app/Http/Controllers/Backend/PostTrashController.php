<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\PostSubcategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class PostTrashController extends Controller
{
    public function loadPostSubcategoryAjax($pcategory_id)
    {
        $postSubcategories = PostSubcategory::where('pcategory_id', $pcategory_id)->select('id', 'subcategory_name')->get();
        return response()->json($postSubcategories, 200);
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->with('user')->latest('id')->select(['id', 'pcategory_id', 'subcategory_id', 'user_id',
        'post_name', 'post_slug', 'post_description', 'post_image', 'is_approved', 'is_active',
        'admin_comment', 'updated_at'])->paginate(20);

        return view('backend.pages.posts.trash', compact('posts'));
    }

    public function restore($post_slug)
    {
        $post = Post::onlyTrashed()->where('post_slug', $post_slug)->first();
        $post->restore();

        Toastr::success('Data Restored Successfully!');
        return redirect()->route('post.index');
    }

    public function forceDelete($post_slug)
    {
        $post = Post::onlyTrashed()->where('post_slug', $post_slug)->first();
        if($post->post_image != 'default_post.jpg'){
            $photo_location = 'uploads/posts/'.$post->post_image;
            unlink($photo_location);
        }
        $post->forceDelete();

        Toastr::success('Data Has Been Deleted Permanently!');
        return redirect()->route('post.index');
    }

}
