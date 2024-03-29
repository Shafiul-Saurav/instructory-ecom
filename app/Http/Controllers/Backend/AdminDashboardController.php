<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $total_earning = Order::sum('total');
        $total_order_count = Order::count();
        $total_categories = Category::count();
        $total_customers = User::where('role_id', 2)->count();
        $total_products = Product::count();
        $total_comments = Comment::count();

        $orders = Order::with('billing', 'orderdetails')->latest('id')->paginate(15);

        $order_on_2020 = Order::whereBetween('created_at', ['2020-01-01', '2020-12-31'])->count();
        $order_on_2021 = Order::whereBetween('created_at', ['2021-01-01', '2021-12-31'])->count();
        $order_on_2022 = Order::whereBetween('created_at', ['2022-01-01', '2022-12-31'])->count();
        $order_on_2023 = Order::whereBetween('created_at', ['2023-01-01', '2023-12-31'])->count();

        $order_yearwise = array($order_on_2020, $order_on_2021, $order_on_2022, $order_on_2023);


        // return $order_weekwise;

        return view('backend.pages.dashboard',
        compact(
            'total_earning',
            'total_order_count',
            'total_categories',
            'total_customers',
            'total_products',
            'total_comments',
            'orders',
            'order_yearwise'
        ));
    }
}
