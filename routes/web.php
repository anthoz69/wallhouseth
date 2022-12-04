<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderDetailController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\UserAddressController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/excel-download', [ProductController::class, 'download'])->name('excel-download');

    // Permissions
    Route::resource('permissions', PermissionController::class, ['except' => ['store', 'update', 'destroy']]);

    // Roles
    Route::resource('roles', RoleController::class, ['except' => ['store', 'update', 'destroy']]);

    // Users
    Route::resource('users', UserController::class, ['except' => ['store', 'update', 'destroy']]);

    // Product
    Route::post('products/media', [ProductController::class, 'storeMedia'])->name('products.storeMedia');
    Route::get('products/import', [ProductController::class, 'import'])->name('products.import');
    Route::resource('products', ProductController::class, ['except' => ['store', 'update', 'destroy']]);

    // Category
    Route::resource('categories', CategoryController::class, ['except' => ['store', 'update', 'destroy']]);

    // Coupon
    Route::resource('coupons', CouponController::class, ['except' => ['store', 'update', 'destroy']]);

    // Slide
    Route::post('slides/media', [SlideController::class, 'storeMedia'])->name('slides.storeMedia');
    Route::resource('slides', SlideController::class, ['except' => ['store', 'update', 'destroy']]);

    // Banner
    Route::post('banners/media', [BannerController::class, 'storeMedia'])->name('banners.storeMedia');
    Route::resource('banners', BannerController::class, ['except' => ['store', 'update', 'destroy']]);

    // User Address
    Route::resource('user-addresses', UserAddressController::class, ['except' => ['store', 'update', 'destroy']]);

    // Order
    Route::resource('orders', OrderController::class, ['except' => ['store', 'update', 'destroy']]);

    // Order Detail
    Route::resource('order-details', OrderDetailController::class, ['except' => ['store', 'update', 'destroy']]);

    // Popup
    Route::post('popups/media', [PopupController::class, 'storeMedia'])->name('popups.storeMedia');
    Route::resource('popups', PopupController::class, ['except' => ['store', 'update', 'destroy']]);
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});
