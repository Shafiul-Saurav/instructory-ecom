<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CategoryTrashController extends Controller
{
    public function trash()
    {
        $categories = Category::onlyTrashed()->latest('id')->select(['id', 'title', 'slug', 'is_active', 'category_image',
        'updated_at'])->paginate();
        // return $categories;
        return view('backend.pages.category.trash', compact('categories'));
    }

    public function restore($slug)
    {
        $category = Category::onlyTrashed()->where('slug', $slug)->first();
        $category->restore();

        Toastr::success('Data Restored Successfully!');
        return redirect()->route('category.index');
    }

    public function forceDelete($slug)
    {
        $category = Category::onlyTrashed()->where('slug', $slug)->first();
        if($category->category_image != 'category-default.png'){
            $photo_location = 'uploads/categories/'.$category->category_image;
            unlink($photo_location);
        }
        $category->forceDelete();

        Toastr::success('Data Has Been Deleted Permanently!');
        return redirect()->route('category.index');
    }
}
