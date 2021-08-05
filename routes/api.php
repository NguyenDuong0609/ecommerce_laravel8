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
    });
});