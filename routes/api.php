<?php

use App\Http\Controllers\API\v1\ProductController;
use App\Http\Controllers\API\v1\UsersController;
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
//
//Route::middleware('auth:sanctum')->group(function () {
//
//
//});

Route::controller(UsersController::class)->group(function() {

    Route::post('customer/login', 'login');

    Route::post('customer/register', 'register');

    Route::post('customer/forgot-password', 'forgotPassword');
});

Route::controller(ProductController::class)->group(function() {

    Route::get('products', 'products');

    Route::get('product/{product_id}', 'productDetails');

});
