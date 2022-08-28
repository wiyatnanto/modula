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
use Modules\Module\Http\Livewire\Modules\Table as ModuleTable;
use Modules\Module\Http\Livewire\Modules\Setting as Setting;

Route::prefix('module')->group(function() {
    Route::get('/', ModuleTable::class);
    Route::get('/setting/{name}', Setting::class);
});
