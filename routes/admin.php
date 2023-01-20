<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin'], function () {

    Route::get('login', [\App\Http\Controllers\Admin\AdminController::class, 'loginPage'])->name('admin.login');
    Route::post('postLogin', [\App\Http\Controllers\Admin\AdminController::class, 'postLogin'])->name('postLogin');
    Route::get('template', [\App\Http\Controllers\Admin\AdminController::class, 'template'])->name('template');
    Route::get('logout', [\App\Http\Controllers\Admin\AdminController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth.admin')->group(function () {

        Route::get('', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');

        Route::group(['prefix' => 'product'], function () {
            Route::get('', [\App\Http\Controllers\Admin\ProductController::class, 'add'])->name('add.product');
            Route::post('create', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('store.product');
            Route::get('list', [\App\Http\Controllers\Admin\ProductController::class, 'read'])->name('view.products');
            Route::post('delete', [\App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('delete.product');
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('edit.product');
            Route::get('getPhoto/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'getPhoto'])->name('get.photo');
            Route::post('update/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('update.product');
            Route::post('updatePhoto/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'storephoto'])->name('update.photo');
            Route::post('destroy/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('destroy.photo');
        });

        Route::group(['prefix' => 'categories'], function () {
            Route::get('', [\App\Http\Controllers\Admin\CategoryController::class, 'add'])->name('add.categories');
            Route::post('create', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('store.category');
            Route::get('list', [\App\Http\Controllers\Admin\CategoryController::class, 'read'])->name('view.categories');
            Route::post('delete', [\App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('delete.category');
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('edit.category');
            Route::post('update/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('update.category');
        });

        Route::group(['prefix' => 'brands'], function () {
            Route::get('', [\App\Http\Controllers\Admin\BrandController::class, 'add'])->name('add.brands');
            Route::post('create', [\App\Http\Controllers\Admin\BrandController::class, 'store'])->name('store.brand');
            Route::get('list', [\App\Http\Controllers\Admin\BrandController::class, 'read'])->name('view.brands');
            Route::post('delete', [\App\Http\Controllers\Admin\BrandController::class, 'delete'])->name('delete.brand');
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\BrandController::class, 'edit'])->name('edit.brand');
            Route::post('update/{id}', [\App\Http\Controllers\Admin\BrandController::class, 'update'])->name('update.brand');
        });

        Route::group(['prefix' => 'colors'], function () {
            Route::get('', [\App\Http\Controllers\Admin\ColorController::class, 'add'])->name('add.color');
            Route::post('create', [\App\Http\Controllers\Admin\ColorController::class, 'store'])->name('store.color');
            Route::get('list', [\App\Http\Controllers\Admin\ColorController::class, 'read'])->name('view.colors');
            Route::post('delete', [\App\Http\Controllers\Admin\ColorController::class, 'delete'])->name('delete.color');
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\ColorController::class, 'edit'])->name('edit.color');
            Route::post('update/{id}', [\App\Http\Controllers\Admin\ColorController::class, 'update'])->name('update.color');
        });

        Route::group(['prefix' => 'offers'], function () {
            Route::get('', [\App\Http\Controllers\Admin\OfferController::class, 'add'])->name('add.offer');
            Route::post('create', [\App\Http\Controllers\Admin\OfferController::class, 'store'])->name('store.offer');
            Route::get('list', [\App\Http\Controllers\Admin\OfferController::class, 'read'])->name('view.offers');
            Route::post('delete', [\App\Http\Controllers\Admin\OfferController::class, 'delete'])->name('delete.offer');

        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('list', [\App\Http\Controllers\Admin\OrderController::class, 'read'])->name('view.orders');
            Route::post('delete', [\App\Http\Controllers\Admin\OrderController::class, 'delete'])->name('delete.order');
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'edit'])->name('edit.order');
            Route::post('update/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'update'])->name('update.order');
        });
    });
});


