<?php

use App\Http\Controllers\Backoffice\CouponController;
use App\Http\Controllers\Backoffice\DashboardController;
use App\Http\Controllers\Backoffice\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('products/import', [ProductController::class, 'getImport'])
        ->name('products.import.index');
    Route::post('products/import', [ProductController::class, 'storeImport'])
        ->name('products.import.store');
    Route::resource('products', ProductController::class);

    Route::resource('coupons', CouponController::class);
});
