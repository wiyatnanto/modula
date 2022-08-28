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
use Modules\Store\Http\Livewire\Product\Table as ProductTable;
use Modules\Store\Http\Livewire\Product\Create as ProductCreate;
use Modules\Store\Http\Livewire\Product\Update as ProductUpdate;
use Modules\Store\Http\Livewire\Brand\Table as BrandTable;
use Modules\Store\Http\Livewire\Category\Table as CategoryTable;
use Modules\Store\Http\Livewire\StoreFront\Table as StoreFrontTable;
use Modules\Store\Http\Livewire\StoreFront\Update as StoreFrontUpdate;

use Modules\Store\Http\Livewire\UnderConstruction;


Route::prefix('store')->middleware('auth')->group(function() {
    Route::get('/', function () {
        return redirect('/store/product');
    });
    Route::get('/product', ProductTable::class)->name('store.product');
    Route::get('/product/add-product', ProductCreate::class)->name('store.product.add');
    Route::get('/product/edit-product/{id}', ProductUpdate::class)->name('store.product.edit');
    Route::get('/brand', BrandTable::class)->name('store.brand');
    Route::get('/category', CategoryTable::class)->name('store.category');
    Route::get('/storefront', StoreFrontTable::class)->name('store.storefront');
    Route::get('/storefront/{id}', StoreFrontUpdate::class)->name('store.storefront.update');
    Route::get('/sale', UnderConstruction::class)->name('store.sale');
    Route::get('/ship', UnderConstruction::class)->name('store.ship');
});
