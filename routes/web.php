<?php

use App\Models\Order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Backend\CouponTrashcontroller;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\ProductTrashController;
use App\Http\Controllers\Backend\CategoryTrashController;
use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\CustomerController as BackendCustomerController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PostCategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\PostSubcategoryController;
use App\Http\Controllers\Backend\PostSubcategoryTrashController;
use App\Http\Controllers\Backend\PostTrashController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Backend\TestimonialTrashController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostCategoryTrashController;

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


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::prefix('')->group(function() {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/shop', [HomeController::class, 'shopPage'])->name('shop.page');
    Route::get('single_product/{slug}', [HomeController::class, 'productDetails'])->name('single.product');
    Route::get('shopping_card', [CartController::class, 'shoppingCard'])->name('shopping.card');
    Route::get('wish_list', [CartController::class, 'wishList'])->name('wish.list');
    Route::post('add_to_cart', [CartController::class, 'addToCard'])->name('add_to.cart');
    Route::get('remove_from_cart/{cart_id}', [CartController::class, 'removeFromCart'])->name('remove_from.cart');
    Route::get('blog', [HomeController::class, 'blogPage'])->name('blog.page');
    Route::get('single_post/{post_slug}', [HomeController::class, 'postDetails'])->name('single.post');

    //Customer Auth Routes
    Route::get('/register', [RegisterController::class, 'registerPage'])->name('register.page');
    Route::post('/register', [RegisterController::class, 'registerStore'])->name('register.store');
    Route::get('/login', [RegisterController::class, 'loginPage'])->name('login.page');
    Route::post('/login', [RegisterController::class, 'loginStore'])->name('login.store');

    /*AJAX Call */
    Route::get('/upzilla/ajax/{district_id}', [CheckoutController::class, 'loadUpazillaAjax'])->name('loadupazila.ajax');

    Route::prefix('customer/')->middleware('auth', 'is_customer')->group(function(){
        Route::get('dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
        Route::get('logout', [RegisterController::class, 'logout'])->name('customer.logout');

        //Coupon Apply & Remove
        Route::post('cart/apply-coupon', [CartController::class, 'couponApply'])->name('customer.couponapply');
        Route::get('cart/remove-coupon/{coupon_name}', [CartController::class, 'removeCoupon'])->name('customer.couponremove');

        //Checkout Page
        Route::get('checkout_page', [CheckoutController::class, 'checkOut'])->name('checkout.page');
        Route::post('placeorder', [CheckoutController::class, 'placeOrder'])->name('customer.placeorder');

        //Customer mail
        Route::get('email', function(){
            $order = Order::whereId(5)->with(['billing', 'orderdetails'])->get();
            return view('frontend.mail.purchaseconfirm', [
                'order_details' => $order
            ]);
        });

        //Customer Comment
        Route::resource('post_comment', CommentController::class);

    });
});



/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/

//Admin Auth Routes
Route::prefix('admin/')->group(function(){
    Route::get('login', [LoginController::class, 'loginPage'])->name('admin.loginpage');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');

    Route::middleware(['auth', 'is_admin'])->group(function(){
        Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])
        ->name('admin.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

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

        Route::get('order/list', [OrderController::class, 'orderList'])->name('order.list');
        Route::get('customer/list', [BackendCustomerController::class, 'customerList'])->name('customer.list');

        /*
        |--------------------------------------------------------
        | Blog Route
        |--------------------------------------------------------
        */

        //PostCategory Controller
        Route::get('post_category/trash', [PostCategoryTrashController::class, 'trash'])
        ->name('post_category.trash');
        Route::get('post_category/{category_slug}/restore', [PostCategoryTrashController::class, 'restore'])
        ->name('post_category.restore');
        Route::delete('post_category/{category_slug}/forcedelete', [PostCategoryTrashController::class, 'forceDelete'])
        ->name('post_category.forcedelete');
        Route::resource('post_category', PostCategoryController::class);

        //PostSubcategory Controller
        Route::get('post_subcategory/trash', [PostSubcategoryTrashController::class, 'trash'])
        ->name('post_subcategory.trash');
        Route::get('post_subcategory/{subcategory_slug}/restore', [PostSubcategoryTrashController::class, 'restore'])
        ->name('post_subcategory.restore');
        Route::delete('post_subcategory/{subcategory_slug}/forcedelete', [PostSubcategoryTrashController::class, 'forceDelete'])
        ->name('post_subcategory.forcedelete');
        /*AXIOS Call */
        Route::get('get-postsubcategory/{id}', [PostSubcategoryController::class, 'getSubCategoryByCategoryId']);
        Route::resource('post_subcategory', PostSubcategoryController::class);

        //Post Controller
        Route::get('post/trash', [PostTrashController::class, 'trash'])
        ->name('post.trash');
        Route::get('post/{post_slug}/restore', [PostTrashController::class, 'restore'])
        ->name('post.restore');
        Route::delete('post/{post_slug}/forcedelete', [PostTrashController::class, 'forceDelete'])
        ->name('post.forcedelete');
        Route::resource('post', PostController::class);
    });
});
