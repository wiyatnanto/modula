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
use Modules\Core\Http\Livewire\Setting\Menu\Table as TableMenu;

Route::prefix('core')->group(function() {
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/menu', TableMenu::class);
    });
});
