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
use Modules\Auth\Http\Controllers\AuthController;
use Modules\Auth\Http\Controllers\UserController;
use Modules\Auth\Http\Controllers\RoleController;
use Modules\Auth\Http\Controllers\PermissionController;

use Modules\Auth\Http\Livewire\Auth\Login;
use Modules\Auth\Http\Livewire\Users\Table;

Route::prefix('auth')->group(function() {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', Login::class)->name('login');
        Route::post('/login', 'postLogin')->name('login.post');
        Route::get('/logout', 'logout')->name('logout');
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'postRegister')->name('register.post');
        Route::get('/recover', 'recover');
        Route::get('/google', 'redirectToGoogle');
        Route::get('/google/callback', 'handleGoogleCallback');
    });
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/users', Table::class);
        // Route::resources([
        //     'users' => UserController::class,
        //     'roles' => RoleController::class,
        //     'permissions' => PermissionController::class,
        // ]);
    });
});
