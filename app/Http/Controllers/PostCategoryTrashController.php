<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class PostCategoryTrashController extends Controller
{
    public function trash()
    {
        $postCategories = PostCategory::onlyTrashed()->latest('id')
        ->select(['id', 'category_name', 'category_slug', 'pcategory_image', 'is_active', 'created_at'])
        ->paginate(20);

        return view('backend.pages.post_category.trash', compact('postCategories'));
    }

    public function restore($category_slug)
    {
        $postCategory = PostCategory::onlyTrashed()->where('category_slug', $category_slug)->first();
        $postCategory->restore();

        Toastr::success('Data Restored Successfully');
        return redirect()->route('post_category.index');
    }

    public function forceDelete($category_slug)
    {
        $postCategory = PostCategory::onlyTrashed()->where('category_slug', $category_slug)->first();

        if($postCategory->pcategory_image != 'default_pcategory.jpg'){
            $photo_location = 'uploads/pcategories/'.$postCategory->pcategory_image;
            unlink($photo_location);
        }
        $postCategory->forceDelete();

        Toastr::success('Data Has Been Deleted Permanently!');
        return redirect()->route('post_category.index');
    }
}
