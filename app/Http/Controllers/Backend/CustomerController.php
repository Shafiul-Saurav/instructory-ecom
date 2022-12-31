<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CustomerController extends Controller
{
    public function customerList()
    {
        $customers = User::where('role_id', 2)->latest('id')
        ->select('id', 'name', 'email', 'phone', 'created_at')->paginate(15);

        return view('backend.pages.customer.index', compact('customers'));

    }

    public function customerDelete($id)
    {
        // dd($id);
        $customer = User::where('id', $id)->first();
        $customer->delete();

        Toastr::success('Customer Has Been Deleted Successfully!');
        return redirect()->back();
    }
}
