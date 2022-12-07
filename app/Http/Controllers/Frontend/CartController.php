<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function shoppingCard()
    {
        $carts = Cart::content();
        $total_price = Cart::subtotal();

        // return $carts;
        return view('frontend.pages.shopping_cart', compact('carts', 'total_price'));
    }

    public function addToCard(Request $request)
    {
        // dd($request->all());
        $slug = $request->slug;
        $order_quantity = $request->order_quantity;

        $product = Product::where('slug', $slug)->first();

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->product_price,
            'weight' => 0,
            'product_stock' => $product->product_stock,
            'qty' => $order_quantity,
            'options' => [
                'product_image' => $product->product_image
            ]
        ]);

        Toastr::success('Product Added in to Cart');
        return back();
    }
}
