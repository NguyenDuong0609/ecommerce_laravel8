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
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
Route::get('/admin/login/', [App\Http\Controllers\AdminController::class, 'login']);


// Route Client
Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('/product-detail', [App\Http\Controllers\IndexController::class, 'productDetail']);
Route::get('/category/{category_id}', [App\Http\Controllers\IndexController::class, 'productCategory']);
Route::get('/product/{product_id}', [App\Http\Controllers\IndexController::class, 'productDetail']);
