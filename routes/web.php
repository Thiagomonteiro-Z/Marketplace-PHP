<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductPhotoController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\Admin\NotificationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [HomeController::class, 'single'])->name('product.single');
Route::get('/category/{slug}', [CategoryController::class, 'index'])->name('category.single');
Route::get('/store/{slug}', [StoreController::class, 'index'])->name('store.single');


Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('add', [CartController::class, 'add'])->name('add');

    Route::get('remove/{slug}', [CartController::class, 'remove'])->name('remove');
    Route::get('cancel', [CartController::class, 'cancel'])->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('proccess', [CheckoutController::class, 'proccess'])->name('proccess');
    Route::get('thanks', [CheckoutController::class, 'thanks'])->name('thanks');
});

Route::get('my-orders', [UserOrderController::class, 'index'])->name('user.orders')->middleware('auth');

Route::group(['middleware' => ['auth', 'access.control.store.admin']], function () {
        Route::prefix('admin')->name('admin.')->group(function () {

            Route::get('notifications', [NotificationController::class, 'notifications'])->name('notifications.index');
            Route::get('notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.read.all');
            Route::get('notifications/read/{id}', [NotificationController::class, 'read'])->name('notifications.read');



            Route::resource('stores', StoreController::class);

            Route::resource('products', ProductController::class);

            Route::resource('categories', CategoryController::class);

            Route::post('photo/remove', [ProductPhotoController::class, 'removePhoto'])->name('photo.remove');

            Route::get('orders/my', [OrdersController::class, 'index'])->name('orders.my');
        });
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
