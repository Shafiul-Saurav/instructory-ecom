<?php

namespace App\Http\Controllers\Backend;

use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CouponTrashcontroller extends Controller
{
    public function trash()
    {
        $coupons = Coupon::onlyTrashed()->latest('id')->select(['id', 'coupon_name', 'discount_amount',
        'minimum_purchase_amount', 'validity_till', 'is_active', 'updated_at'])->paginate(20);
        return view('backend.pages.coupon.trash', compact('coupons'));
    }

    public function restore($id)
    {
        // dd($id);
        $coupon = Coupon::onlyTrashed()->where('id', $id)->first();
        $coupon->restore();

        Toastr::success('Coupon Restored Successfully');
        return redirect()->route('coupon.index');
    }

    public function forceDelete($id)
    {
        $coupon = Coupon::onlyTrashed()->where('id', $id)->first();
        $coupon->forceDelete();

        Toastr::success('Coupon Has Been Deleted Permanently!');
        return redirect()->route('coupon.index');
    }
}
