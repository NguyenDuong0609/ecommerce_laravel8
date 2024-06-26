<?php

use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin-login', [App\Http\Controllers\AdminController::class, 'login']);
Route::any('/admin/{all}', [App\Http\Controllers\AdminController::class, 'index'])->where(['all' => '.*']);

// Route Client
Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('/product-detail', [App\Http\Controllers\IndexController::class, 'productDetail']);
Route::get('/category/{category_id}', [App\Http\Controllers\IndexController::class, 'productCategory']);
Route::get('/product/{product_id}', [App\Http\Controllers\IndexController::class, 'productDetail']);
Route::get('/search', [App\Http\Controllers\IndexController::class, 'search'])->name('search');
Route::get('/sort', [App\Http\Controllers\IndexController::class, 'sort']);

// Route Cart
Route::get('/add-to-cart', [App\Http\Controllers\CartController::class, 'addCart']);
Route::post('cart/store', [App\Http\Controllers\CartController::class, 'storeCart'])->name('cart.store');
Route::get('cart', [App\Http\Controllers\CartController::class, 'cart']);
Route::get('update-cart', [App\Http\Controllers\CartController::class, 'updateCart'])->name('cart.update');
Route::delete('delete-cart', [App\Http\Controllers\CartController::class, 'deleteCart'])->name('cart.delete');
Route::get('checkout', [App\Http\Controllers\CartController::class, 'checkout']);
Route::post('coupon',  [App\Http\Controllers\CartController::class, 'applyCoupon'])->name('cart.coupon');

// Route Checkout
Route::resource('orders', App\Http\Controllers\OrderController::class);

//Route paypal
Route::get('paypal/checkout/{order}', [App\Http\Controllers\PayPalController::class, 'getExpressCheckout'])->name('paypal.checkout');
Route::get('paypal/checkout-success/{order}', [App\Http\Controllers\PayPalController::class, 'getExpressCheckoutSuccess'])->name('paypal.success');
Route::get('paypal/checkout-cancel', [App\Http\Controllers\PayPalController::class, 'cancelPage'])->name('paypal.cancel');

// Route Social
Route::get('auth/google', [App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallBack']);