<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CategoryTrashController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CouponTrashcontroller;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductTrashController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\TestimonialTrashController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('frontend.pages.home');
// });

Route::prefix('')->group(function() {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/shop', [HomeController::class, 'shopPage'])->name('shop.page');
    Route::get('single_product/{slug}', [HomeController::class, 'productDetails'])->name('single.product');
    Route::get('shopping_card', [CartController::class, 'shoppingCard'])->name('shopping.card');
    Route::post('add_to_cart', [CartController::class, 'addToCard'])->name('add_to.cart');
    Route::get('remove_from_cart/{cart_id}', [CartController::class, 'removeFromCart'])->name('remove_from.cart');
});

Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])
->name('admin.dashboard');

// Category Controller
Route::get('category/trash', [CategoryTrashController::class, 'trash'])
->name('category.trash');
Route::get('category/{slug}/restore', [CategoryTrashController::class, 'restore'])
->name('category.restore');
Route::delete('category/{slug}/forcedelete', [CategoryTrashController::class, 'forceDelete'])
->name('category.forcedelete');
Route::resource('category', CategoryController::class);

// Testimonial Controller
Route::get('testimonial/trash', [TestimonialTrashController::class, 'trash'])
->name('testimonial.trash');
Route::get('testimonial/{client_name_slug}/restore', [TestimonialTrashController::class, 'restore'])
->name('testimonial.restore');
Route::delete('testimonial/{client_name_slug}/forcedelete', [TestimonialTrashController::class, 'forceDelete'])
->name('testimonial.forcedelete');
Route::resource('testimonial', TestimonialController::class);

// Product Controller
Route::get('product/trash', [ProductTrashController::class, 'trash'])
->name('product.trash');
Route::get('product/{slug}/restore', [ProductTrashController::class, 'restore'])
->name('product.restore');
Route::delete('product/{slug}/forcedelete', [ProductTrashController::class, 'forceDelete'])
->name('product.forcedelete');
Route::resource('product', ProductController::class);

// Coupon Controller
Route::get('coupon/trash', [CouponTrashcontroller::class, 'trash'])
->name('coupon.trash');
Route::get('coupon/restore/{id}', [CouponTrashcontroller::class, 'restore'])
->name('coupon.restore');
Route::delete('coupon/forcedelete/{id}', [CouponTrashcontroller::class, 'forceDelete'])
->name('coupon.forcedelete');
Route::resource('coupon', CouponController::class);


/*Admin Auth routes */
Route::prefix('admin/')->group(function(){
    Route::get('login', [LoginController::class, 'loginPage'])->name('admin.loginpage');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth'])->group(function(){
        Route::get('dashboard', function () {
            return view('backend.pages.Dashboard');
        })->name('admin.dashboard');
    });
});
