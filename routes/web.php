<?php

use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\TestimonialTrashController;
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
Route::get('/', function () {
    return view('frontend.pages.home');
});

Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');

// Category Controller
Route::resource('category', CategoryController::class);

// Testimonial Controller
Route::get('testimonial/trash', [TestimonialTrashController::class, 'trash'])->name('testimonial.trash');
Route::get('testimonial/{slug}restore', [TestimonialTrashController::class, 'restore'])->name('testimonial.restore');
Route::get('testimonial/{slug}forcedelete', [TestimonialTrashController::class, 'forceDelete'])->name('testimonial.forcedelete');
Route::resource('testimonial', TestimonialController::class);





// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
