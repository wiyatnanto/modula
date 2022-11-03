<?php

use Illuminate\Http\Request;

use Modules\Blog\Http\Controllers\API\PostController;
use Modules\Blog\Http\Controllers\API\CategoryController;


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

Route::middleware('auth:api')->get('/blog', function (Request $request) {
    return $request->user();
});

Route::prefix('blog')->middleware('auth:api')->group( function () {
    Route::resource('posts', PostController::class);
    // Route::resource('categories', CategoryController::class);
});
