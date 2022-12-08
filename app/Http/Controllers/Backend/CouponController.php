<?php

namespace App\Http\Controllers\Backend;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\CouponStoreRequest;
use App\Http\Requests\CouponUpdateRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::latest('id')->select(['id', 'coupon_name', 'discount_amount',
        'minimum_purchase_amount', 'validity_till', 'is_active', 'updated_at'])->paginate(20);
        return view('backend.pages.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponStoreRequest $request)
    {
        // dd($request->all());
        $coupon = Coupon::create([
            'coupon_name' => $request->coupon_name,
            'discount_amount' => $request->discount_amount,
            'minimum_purchase_amount' => $request->minimum_purchase_amount,
            'validity_till' => $request->validity_till,
        ]);

        Toastr::success('Coupon Created Successfully');
        return redirect()->route('coupon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::where('id', $id)->first();
        return view('backend.pages.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponUpdateRequest $request, $id)
    {
        // dd($id);
        $coupon = Coupon::where('id', $id)->first();
        $coupon->update([
            'coupon_name' => $request->coupon_name,
            'discount_amount' => $request->discount_amount,
            'minimum_purchase_amount' => $request->minimum_purchase_amount,
            'validity_till' => $request->validity_till,
            'is_active' => $request->filled('is_active')
        ]);

        Toastr::success('Coupon Updated Successfully');
        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::where('id', $id)->first();
        $coupon->delete();

        Toastr::success('Coupon Deleted Successfully');
        return redirect()->route('coupon.index');
    }
}
