<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function customerList()
    {
        $customers = User::where('role_id', 2)->latest('id')
        ->select('id', 'name', 'email', 'phone', 'created_at')->paginate(15);

        return view('backend.pages.customer.index', compact('customers'));

    }
}
