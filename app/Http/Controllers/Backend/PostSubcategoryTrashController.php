<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\PostSubcategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class PostSubcategoryTrashController extends Controller
{
    public function trash()
    {
        $postSubcategories = PostSubcategory::onlyTrashed()->latest('id')
        ->select(['id', 'pcategory_id', 'subcategory_name', 'subcategory_slug', 'subcategory_image',
        'is_active', 'updated_at'])->paginate(20);

        return view('backend.pages.post-subcategory.trash', compact('postSubcategories'));
    }

    public function restore($subcategory_slug)
    {
        $postSubcategory = PostSubcategory::onlyTrashed()->where('subcategory_slug', $subcategory_slug)->first();
        $postSubcategory->restore();

        Toastr::success('Data Restored Successfully!');
        return redirect()->route('post_subcategory.index');
    }

    public function forceDelete($subcategory_slug)
    {
        $postSubcategory = PostSubcategory::onlyTrashed()->where('subcategory_slug', $subcategory_slug)->first();
        if($postSubcategory->subcategory_image != 'default_subcategory.jpg'){
            $photo_location = 'uploads/subcategories/'.$postSubcategory->subcategory_image;
            unlink($photo_location);
        }
        $postSubcategory->forceDelete();

        Toastr::success('Data Has Been Deleted Permanently!');
        return redirect()->route('post_subcategory.index');
    }
}
