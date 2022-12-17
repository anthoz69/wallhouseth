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
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => true]);


Route::get('/', [UserHomeController::class, 'index']);
Route::get('cart', [CartController::class, 'index'])
    ->name('cart');
Route::post('cart', [CartController::class, 'store'])
    ->name('cart.store');
Route::put('cart', [CartController::class, 'update'])
    ->name('cart.update');
Route::get('cart/delete/{cart}', [CartController::class, 'destroy'])
    ->name('cart.destroy');
Route::get('cart/clear', [CartController::class, 'clear'])
    ->name('cart.clear');

Route::get('products', [\App\Http\Controllers\User\ProductController::class, 'index'])
    ->name('products.index');
Route::get('products/{product}', [\App\Http\Controllers\User\ProductController::class, 'show'])
    ->name('products.show');

Route::get('category/{category}', [\App\Http\Controllers\User\CategoryController::class, 'show'])
    ->name('category.show');

Route::group(['as' => 'user.', 'middleware' => ['auth']], function () {
    Route::get('/user/dashboard', [\App\Http\Controllers\User\UserController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('checkout', [CheckoutController::class, 'index'])
        ->name('checkout');
    Route::post('checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    Route::post('checkout/shipping-list', [CheckoutController::class, 'getShippingList']);
});

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
