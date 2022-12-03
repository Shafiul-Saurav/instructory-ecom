<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function home()
    {
        $testimonials = Testimonial::where('is_active', 1)->latest('id')->limit(3)->select(['id',
        'client_name', 'client_designation', 'client_message', 'client_image'])->get();

        $categories = Category::where('is_active', 1)->latest('id')->limit(6)->select(['id',
        'title', 'category_image'])->get();

        $products = Product::where('is_active', 1)->latest('id')->limit(8)
        ->select(['id', 'category_id', 'name', 'slug', 'product_price', 'product_stock',
        'product_image', 'product_rating'])->paginate(8);

        // return $products;

        return view('frontend.pages.home', compact('testimonials', 'categories', 'products'));
    }

    public function shopPage()
    {
        $allproducts = Product::where('is_active', 1)->latest('id')->select(['id', 'name', 'slug', 'product_price', 'product_stock',
        'product_image', 'product_rating'])->paginate(12);

        $categories = Category::where('is_active', 1)->with('products')->latest('id')->limit(6)->select(['id',
        'title', 'slug'])->get();

        return view('frontend.pages.shop', compact('allproducts', 'categories'));
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->with('category', 'productImages')->first();

        $related_products = Product::whereNot('slug', $slug)->limit(4)
        ->select(['id', 'name', 'slug', 'product_price', 'product_image', 'product_rating'])
        ->get();

        return view('frontend.pages.single_product', compact('product', 'related_products'));
    }

}
