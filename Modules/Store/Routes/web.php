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
use Modules\Store\Http\Livewire\Products\Table as ProductTable;
use Modules\Store\Http\Livewire\Products\Create as ProductCreate;
use Modules\Store\Http\Livewire\Products\Update as ProductUpdate;
use Modules\Store\Http\Livewire\Brands\Table as BrandTable;
use Modules\Store\Http\Livewire\Categories\Table as CategoryTable;
use Modules\Store\Http\Livewire\StoreFronts\Table as StoreFrontTable;
use Modules\Store\Http\Livewire\StoreFronts\Update as StoreFrontUpdate;


Route::prefix('store')->middleware('auth')->group(function() {
    Route::get('/products', ProductTable::class)->name('store.product');
    Route::get('/products/add-product', ProductCreate::class)->name('store.product.add');
    Route::get('/products/edit-product/{id}', ProductUpdate::class)->name('store.product.edit');
    Route::get('/brands', BrandTable::class)->name('store.brand');
    Route::get('/categories', CategoryTable::class)->name('store.category');
    Route::get('/storefronts', StoreFrontTable::class)->name('store.storefront');
    Route::get('/storefronts/{id}', StoreFrontUpdate::class)->name('store.storefront.update');
});
