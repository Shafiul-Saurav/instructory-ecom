<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class ProductTrashController extends Controller
{
    public function trash()
    {
        $products = Product::onlyTrashed()
        ->where('is_active', 1)
        ->with('category')
        ->latest('id')
        ->select(['id', 'category_id', 'name', 'slug', 'product_price', 'product_stock',
         'alert_quantity', 'product_image', 'product_rating', 'is_active', 'updated_at'])
         ->paginate(30);
        //  return $products;
        return view('backend.pages.product.trash', compact('products'));
    }

    public function restore($slug)
    {
        $product = Product::onlyTrashed()->where('slug', $slug)->first();
        $product->restore();

        Toastr::success('Product Restored Successfully!');
        return redirect()->route('product.index');
    }

    public function forceDelete($slug)
    {
        $product = Product::onlyTrashed()->where('slug', $slug)->first();
        if($product->product_image != 'default_product.jpg'){
            $photo_location = 'uploads/products/'.$product->product_image;
            unlink($photo_location);
        }
        $product->forceDelete();

        Toastr::success('Product Has Been Deleted Permanently!');
        return redirect()->back();
    }
}
