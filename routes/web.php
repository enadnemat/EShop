<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [\App\Http\Controllers\User\NotificationController::class, 'index'])->name('home.index');
    Route::post('/store-token', [\App\Http\Controllers\User\NotificationController::class, 'updateDeviceToken'])->name('store.token');
    Route::post('/send-web-notification', [\App\Http\Controllers\User\NotificationController::class, 'sendNotification'])->name('send.web-notification');
});
Route::group(['prefix' => 'eshop'], function () {

    Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('user.index');

    Route::group(['prefix' => 'user'], function () {
        Route::get('register', [\App\Http\Controllers\User\UserController::class, 'index'])->name('register.page');
        Route::get('login', [\App\Http\Controllers\User\UserController::class, 'login'])->name('user.login');
        Route::post('postRegister', [\App\Http\Controllers\User\UserController::class, 'create'])->name('postRegister');
        Route::post('postLogin', [\App\Http\Controllers\User\UserController::class, 'postLogin'])->name('post-login');
        Route::get('logout', [\App\Http\Controllers\User\UserController::class, 'logout'])->name('user.logout');
    });

    Route::group(['prefix' => 'category', 'middleware' => 'auth:web'], function () {
        Route::get('', [\App\Http\Controllers\User\CategoryController::class, 'index'])->name('shop.category');
    });

    Route::group(['prefix' => 'product', 'middleware' => 'auth:web'], function () {
        Route::get('/{product_id}', [\App\Http\Controllers\User\ProductController::class, 'index'])->name('product.details');

    });
    Route::group(['prefix' => 'cart', 'middleware' => 'auth:web'], function () {
        Route::get('/{id}', [\App\Http\Controllers\User\CartController::class, 'index'])->name('view.cart');
        Route::post('create/{user_id}/{product_id}', [\App\Http\Controllers\User\CartController::class, 'store'])->name('addToCart');
        Route::post('update/{user_id}/{cart_id}', [\App\Http\Controllers\User\CartController::class, 'update'])->name('updateCart');
    });
    Route::group(['prefix' => 'order', 'middleware' => 'auth:web'], function () {
        Route::get('/{user_id}/', [\App\Http\Controllers\User\OrderControlleer::class, 'index'])->name('checkout');
        Route::post('/store/{user_id}', [\App\Http\Controllers\User\OrderControlleer::class, 'storeOrder'])->name('store-order');

    });
});
Auth::routes();
