<?php

namespace App\Http\Controllers\Frontend;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function about()
    {
        $bestSellers = OrderDetail::with(['product'])->latest('id')->limit(4)->select('id', 'product_id')->get();
        return view('frontend.pages.about', compact('bestSellers'));
    }
}
