<?php

use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\VendorController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\PaymentController;
use Illuminate\Support\Facades\Route;

//Index Page
Route::get('/index', [FrontController::class, 'index']);
Route::get('/', [FrontController::class, 'index']);

// Shop Page
Route::get('shop', [FrontController::class, 'shop_page']);
// Categories Page
Route::get('category/{slug}', [FrontController::class, 'Category_link']);
// View Product Details
Route::get('product_details/{slug}', [ProductController::class, 'product_details']);
// Product Review
Route::post('product_review',[ProductController::class,'product_review']);
// User Login Register
Route::get('user/login_register', [UserController::class, 'login_register'])->name('user/login_register');
Route::post('user/register', [UserController::class, 'register']);
// User Login
//Route::post('user/login', [UserController::class, 'user_login']);
Route::match(['post','get'],'user/login',[UserController::class,'user_login']);
Route::group(['middleware' => ['auth']], function () {
    // user Profile
    Route::match(['post', 'get'], 'user/profile', [UserController::class, 'user_profile']);
    // account edit

    Route::match(['post','get'],'user/edit',[UserController::class,'account_edit']);
    // Change Password
    Route::match(['post', 'get'], 'user/update_password', [UserController::class, 'update_password']);
    // Apply Coupon To Users
    Route::post('apply_coupon', [ProductController::class, 'apply_coupon']);
    // CheckOut Page
    Route::match(['post','get'], '/checkout', [CheckoutController::class, 'checkout']);
    Route::get('thanks',[CheckoutController::class,'thanks']);
    // User Orders
    Route::get('orders/index/{id?}',[OrderController::class,'orders']);
    //Start Payment Routes
    Route::match(['post','get'],'payment',[PaymentController::class,'index']);
    Route::controller(\App\Http\Controllers\Front\PaypalController::class)->group(function (){
       Route::get('paypal','paypal');
       Route::post('pay','pay')->name('payment');
       Route::get('success','success');
       Route::get('error','errorPayment');
    });
});


// Confirm User Email
Route::get('user/confirm/{code}', [UserController::class, 'UserConfirm']);
// User Forget Password
//Route::match('user/forget_password',[UserController::class,'forgetPassword']);
Route::match(['post', 'get'], 'user/forget_password', [UserController::class, 'forgetPassword']);
// User LogOut
Route::get('user/logout', [UserController::class, 'user_logout']);
// Vendor Login Register
Route::get('vendor/login_register', [VendorController::class, 'login_register']);
Route::post('vendor/register', [VendorController::class, 'register']);
// Confirm Vendor Email
Route::get('vendor/confirm/{code}', [VendorController::class, 'vendorConfirm']);
// Vendor Products
Route::get('products/{website_name}', [VendorController::class, 'Vendor_products']);
// Add To Cart
Route::post('cart/add', [ProductController::class, 'AddToCart']);
// Show Cart Items
Route::get('cart/show', [ProductController::class, 'showCart']);
// Cart Update
Route::post('cart/update', [ProductController::class, 'cartUpdate']);
// Delete Cart Item
Route::post('/cart/delete', [ProductController::class, 'deleteCart']);
// Contact Page
Route::match(['post', 'get'], 'contact', [FrontController::class, 'contact']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('search-products',[ProductController::class,'SearchProduct']);

require __DIR__ . '/auth.php';
@include 'admin.php';

