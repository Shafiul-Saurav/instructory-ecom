<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Billing;
use App\Models\Product;
use App\Models\Upazila;
use App\Models\District;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Mail\PurchaseConfirm;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\OrderStoreRequest;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function checkOut()
    {
        $carts = Cart::content();
        $total_price = Cart::subtotalFloat();
        $districts = District::select('id', 'name', 'bn_name')->get();
        return view('frontend.pages.checkout', compact('carts', 'total_price', 'districts'));
    }

    public function loadUpazillaAjax($district_id)
    {
        $upazilas = Upazila::where('district_id', $district_id)->select('id','name')->get();
        return response()->json($upazilas, 200);
    }

    public function placeOrder(OrderStoreRequest $request)
    {
        // dd($request->all());

        //Billing Data Insert
        $billing = Billing::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'address' => $request->address,
            'order_note' => $request->order_note,
        ]);

        //Order Data Insert
        $order = Order::create([
            'user_id' => Auth::id(),
            'billing_id' => $billing->id,
            'sub_total' => Session::get('coupon')['cart_total'] ?? round(Cart::subtotalFloat()),
            'discount_amount' => Session::get('coupon')['discount_amount'] ?? 0,
            'coupon_name' => Session::get('coupon')['name'] ?? '',
            'total' => Session::get('coupon')['balance'] ?? round(Cart::subtotalFloat()),
        ]);

        //Order details table data insert using cart_item helpers
        foreach (Cart::content() as $cart_item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'product_id' => $cart_item->id,
                'product_qty' => $cart_item->qty,
                'product_price' => $cart_item->price,
            ]);
        }

        //Update product quantity with decrement quantity
        Product::findOrFail($cart_item->id)->decrement('product_stock', $cart_item->qty);
        Cart::destroy();
        Session::forget('coupon');

        // Now get order with details information to send mail
        $order = Order::whereId($order->id)->with(['billing', 'orderdetails'])->get();

        // Now Send Mail
        Mail::to($request->email)->send(new PurchaseConfirm($order));

        Toastr::success('Your Order Placed Successfully!!!', 'Success');
        return redirect()->route('shopping.card');
    }
}
