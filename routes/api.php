<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Users
Route::prefix('/user')->group( function() {
    Route::post('/login', [App\Http\Controllers\api\v1\AuthController::class, 'login']);
    Route::post('/signup', [App\Http\Controllers\api\v1\AuthController::class, 'signup']);

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::delete('logout', [App\Http\Controllers\api\v1\AuthController::class, 'logout']);
        Route::get('me', [App\Http\Controllers\api\v1\AuthController::class, 'user']);

        Route::get('/', [App\Http\Controllers\api\v1\UserController::class, 'users']);
        Route::get('/{id}', [App\Http\Controllers\api\v1\UserController::class, 'user']);

        Route::put('/{id}', [App\Http\Controllers\api\v1\UserController::class, 'update']);
        Route::delete('/{id}', [App\Http\Controllers\api\v1\UserController::class, 'destroy']);
    });
});

// Categories
Route::prefix('/category')->group( function() {
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('/', [App\Http\Controllers\api\v1\CategoryController::class, 'categories']);
        Route::get('/parent-cate', [App\Http\Controllers\api\v1\CategoryController::class, 'parentCate']);
        Route::get('/{id}', [App\Http\Controllers\api\v1\CategoryController::class, 'category']);

        Route::post('/add', [App\Http\Controllers\api\v1\CategoryController::class, 'create']);
        Route::put('/{id}', [App\Http\Controllers\api\v1\CategoryController::class, 'update']);
        Route::delete('/{id}', [App\Http\Controllers\api\v1\CategoryController::class, 'destroy']);
    });
});


// Products
Route::prefix('/product')->group( function() {
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('/', [\App\Http\Controllers\api\v1\ProductController::class, 'products']);
        Route::get('/{id}', [App\Http\Controllers\api\v1\ProductController::class, 'product']);
        Route::post('/add', [App\Http\Controllers\api\v1\ProductController::class, 'create']);
        Route::post('/{id}', [App\Http\Controllers\api\v1\ProductController::class, 'update']);
        Route::delete('/{id}', [App\Http\Controllers\api\v1\ProductController::class, 'destroy']);
    });
});

// Producers
Route::prefix('/producer')->group(function() {
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('/', [\App\Http\Controllers\api\v1\ProducerController::class, 'producers']);
        Route::post('/add', [\App\Http\Controllers\api\v1\ProducerController::class, 'create']);
        Route::get('/{id}', [\App\Http\Controllers\api\v1\ProducerController::class, 'producer']);
        Route::put('/{id}', [\App\Http\Controllers\api\v1\ProducerController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\api\v1\ProducerController::class, 'destroy']);
    });
});

// Type Product
Route::prefix('/type_product')->group(function() {
    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('/', [\App\Http\Controllers\api\v1\TypeProductController::class, 'type_products']);
        Route::post('/add', [\App\Http\Controllers\api\v1\TypeProductController::class, 'create']);
        Route::get('/{id}', [\App\Http\Controllers\api\v1\TypeProductController::class, 'type_product']);
        Route::put('/{id}', [\App\Http\Controllers\api\v1\TypeProductController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\api\v1\TypeProductController::class, 'destroy']);
    });
});
