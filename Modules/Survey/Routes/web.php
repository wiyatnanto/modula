<?php

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
use Modules\Survey\Http\Controllers\SurveyController;
use Modules\Survey\Http\Livewire\Surveys\Table;
use Modules\Survey\Http\Livewire\Editor\Design;
use Modules\Survey\Http\Livewire\Results;

Route::prefix('survey')->middleware(['auth'])->group(function() {
    Route::get('/', Table::class);
    Route::get('/design/{slug}', Design::class);
    Route::get('/result/{slug}', Results::class);
});
