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

    public function restore($client_name_slug)
    {
        // dd($client_name_slug);
        Testimonial::onlyTrashed()->where('client_name_slug', $client_name_slug)->restore();
        Toastr::success('Category Restored Successfully!');
        return redirect()->route('testimonial.index');
    }

    public function forceDelete($client_name_slug)
    {
        // dd($client_name_slug);
        $testimonial = Testimonial::onlyTrashed()->where('client_name_slug', $client_name_slug)->first();
        if($testimonial->client_image != 'default-client.jpg'){
            $photo_location = 'uploads/testimonials/'.$testimonial->client_image;
            unlink($photo_location);
        }
        $testimonial->forceDelete();

        Toastr::success('Category Deleted Permanently!');
        return redirect()->route('testimonial.index');
    }

}
