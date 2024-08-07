<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\VendorController;
use App\Http\Controllers\admin\SectionController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\UserController;
use \App\Http\Controllers\admin\OrdersController;
use \App\Http\Controllers\admin\AdvantageController;
use \App\Http\Controllers\Front\FrontTitleController;
use \App\Http\Controllers\admin\UnderBannerController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin'], function () {
    // Admin Login
    Route::match(['post', 'get'], '/', [AdminController::class, 'login'])->name('admin_login');
    Route::match(['post', 'get'], 'login', [AdminController::class, 'login'])->name('admin_login');
    // Admin Dashboard
    Route::group(['middleware' => 'Admin'], function () {
        Route::get('dashboard', [AdminController::class, 'dashboard']);

        // update admin password
        Route::match(['post', 'get'], 'update_admin_password', [AdminController::class, 'update_admin_password']);
        // check Admin Password
        Route::post('check_admin_password', [AdminController::class, 'check_admin_password']);
        // Update Admin Details
        Route::match(['post', 'get'], 'update_admin_details', [AdminController::class, 'update_admin_details']);

        ///////////////////////////// START  VENDORS ////////////////////
        /// Updates
        Route::match(['post', 'get'], 'update_vendor/{slug}', [VendorController::class, 'update_vendor']);
        /////////////////////// View Admin , Super Admin , Vendors
        /// Views
        Route::get('admin/{type}', [AdminController::class, 'admins']);
        ////// View Vendor Details
        Route::match(['post', 'get'], 'admin/view_vendor_details/{id}', [VendorController::class, 'view_vendor_details']);

        //////// Update Vendor commission
        Route::post('update_vendor_commission',[VendorController::class,'update_vendor_commission']);
        // Admin Logout
        Route::get('logout', [AdminController::class, 'logout'])->name('admin_logout');


        ///////// START SECTIONS
        Route::get('sections', [SectionController::class, 'sections']);
        Route::post('section/add', [SectionController::class, 'add_section']);
        Route::post('update_section', [SectionController::class, 'update_section']);
        Route::post('delete_section/{id}', [SectionController::class, 'delete_section']);


        // Start Categiries
        Route::get('categories', [CategoriesController::class, 'index']);
        Route::match(['post', 'get'], 'add_category', [CategoriesController::class, 'add']);
        Route::match(['post', 'get'], 'update_category/{id}', [CategoriesController::class, 'update']);
        Route::post('delete_category/{id}', [CategoriesController::class, 'delete']);
        // End Categiries

        // START BRADS

        Route::get('brands',[BrandController::class,'index']);
        Route::post('brands/add',[BrandController::class,'add']);
        Route::post('brands/update',[BrandController::class,'update']);
        Route::post('brands/delete/{id}',[BrandController::class,'delete']);

        // END BRANDS

        // START PRODUCTS

        Route::get('products',[ProductController::class,'index']);

        Route::match(['post','get'],'product/add',[ProductController::class,'add']);

        Route::match(['post','get'],'product/update/{id}',[ProductController::class,'update']);

        Route::post('product/delete/{id}',[ProductController::class,'delete']);

        // Import Product From Excel File
      //  Route::post('products/import',[ProductController::class,'import_data']);
        Route::match(['post','get'],'products/import',[ProductController::class,'import_data']);

        // Make Export Product

        Route::get('products/export',[ProductController::class,'export_data']);

        // START PRODUCT IMAGES

        Route::match(['post','get'],'product/add-images/{id}',[ProductController::class,'add_images']);
       Route::post('product/delete-image/{id}',[ProductController::class,'delete_image']);
        // END PRODUCTS

        // START BANNERS
        Route::get('banners',[BannerController::class,'index']);
        Route::post('banners/add',[BannerController::class,'add']);
        Route::post('banners/update',[BannerController::class,'update']);
        Route::post('banners/delete/{id}',[BannerController::class,'delete']);
        // END BANNERS

        // Start Coupons Code
        Route::get('coupons',[CouponController::class,'index']);
        Route::match(['post','get'],'add_coupon',[CouponController::class,'add_coupon']);
        Route::match(['post','get'],'update_coupon/{id}',[CouponController::class,'update_coupon']);
        Route::post('delete_coupon/{id}',[CouponController::class,'delete_coupon']);

        // Show Users

        Route::get('users',[UserController::class,'index']);
        Route::post('update_user',[UserController::class,'update_user']);

        // Orders

        Route::get('orders',[OrdersController::class,'index']);

        Route::match(['post','get'],'orders/order_details/{id}',[OrdersController::class,'order_details']);

        Route::get('orders/invoice/{id}',[OrdersController::class,'order_invoice']);
        // Update Order Status
        Route::post('update_order_status',[OrdersController::class,'update_order_status']);
        // Update Item  Status
        Route::post('update_item_status',[OrdersController::class,'update_item_status']);
        // Website advatege
        Route::match(['post','get'],'website_advantage',[AdvantageController::class,'index']);
        Route::post('website_advantage/add',[AdvantageController::class,'add']);
        Route::post('website_advantage/edit/{id}',[AdvantageController::class,'edit']);
        Route::post('website_advantage/delete/{id}',[AdvantageController::class,'delete']);

        // Start Front Title controller
        Route::get('front_titles',[FrontTitleController::class,'index']);
        Route::post('front_titles/edit/{id}',[FrontTitleController::class,'edit']);
        // Start Under Banner
        Route::get('under_banner',[UnderBannerController::class,'index']);
        Route::post('under_banner/edit',[UnderBannerController::class,'edit']);
    });
});
