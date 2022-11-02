<?php

use Illuminate\Http\Request;
use Modules\Store\Http\Controllers\API\StoreController;
use Modules\Store\Http\Controllers\API\BrandController;
use Modules\Store\Http\Controllers\API\StoreFrontController;
use Modules\Store\Http\Controllers\API\CategoryController;
use Modules\Store\Http\Controllers\API\BranchController;
use Modules\Store\Http\Controllers\API\PromoBannerController;



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

Route::middleware('auth:api')->get('/store', function (Request $request) {
    return $request->user();
});

Route::prefix('store')->middleware('auth:api')->group( function () {
    Route::resource('products', StoreController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('storefronts', StoreFrontController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('branches', BranchController::class);
    Route::resource('promobanners', PromoBannerController::class);

});
