<?php

namespace App\Http\Controllers\Backend;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class TestimonialTrashController extends Controller
{
    public function trash()
    {
        $testimonials = Testimonial::onlyTrashed()->latest('id')
        ->select(['id', 'client_name', 'client_name_slug', 'client_designation', 'client_message', 'client_image', 'updated_at'])->paginate();
        // return $testimonials;
        return view('backend.pages.testimonial.trash', compact('testimonials'));
    }

    public function restore($slug)
    {
        // dd($slug);
        Testimonial::onlyTrashed()->where('client_name_slug', $slug)->restore();
        Toastr::success('Category Restored Successfully!');
        return redirect()->route('testimonial.index');
    }

    public function forceDelete($slug)
    {
        // dd($slug);
        $testimonial = Testimonial::onlyTrashed()->where('client_name_slug', $slug)->forceDelete();
        if($testimonial->client_image){
            $photo_location = 'uploads/testimonials/'.$testimonial->client_image;
            unlink($photo_location);
        }
        Toastr::success('Category Deleted Permanently!');
        return redirect()->route('testimonial.index');
    }

}
