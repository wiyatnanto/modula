<?php

use Illuminate\Http\Request;
use Modules\Theme\Http\Controllers\API\SliderController;

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

Route::middleware("auth:api")->get("/theme", function (Request $request) {
    return $request->user();
});

Route::prefix("theme")
    ->middleware("auth:api")
    ->group(function () {
        Route::resource("sliders", SliderController::class);
    });
