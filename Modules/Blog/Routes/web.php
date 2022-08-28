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
use Modules\Blog\Http\Livewire\Pages\Table as PagesTable;
use Modules\Blog\Http\Livewire\Posts\Table as PostsTable;
use Modules\Blog\Http\Livewire\Categories\Table as CategoriesTable;
use Modules\Blog\Http\Livewire\Tags\Table as TagsTable;

use Modules\Blog\Http\Controllers\BlogController;

Route::get('/', [BlogController::class, 'index']);
Route::get('/{page_slug}', [BlogController::class, 'openPage']);

Route::prefix('blog')->group(function() {
    Route::get('/', 'BlogController@index');

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/pages', PagesTable::class);
        Route::get('/posts', PostsTable::class);
        Route::get('/categories', CategoriesTable::class);
        Route::get('/tags', TagsTable::class);
    });
});
