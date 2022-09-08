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
use Modules\Crud\Http\Controllers\BuilderController;
use Modules\Crud\Http\Livewire\Cruds\Table as CrudTable;
use Modules\Crud\Http\Livewire\Builder\Config as ConfigInfo;

Route::prefix('crud')->group(function() {
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/build', CrudTable::class)->name('build');
        Route::get('/build/config/{name}', ConfigInfo::class)->name('build.config');
    });
});
