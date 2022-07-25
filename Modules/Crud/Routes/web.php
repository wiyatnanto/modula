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
        Route::get('/build', CrudTable::class);
        Route::get('/build/config/{name}', ConfigInfo::class);
        // Route::get('/roles', RoleTable::class);
        // Route::get('/permissions', PermissionTable::class);
    });
    Route::controller(BuilderController::class)->group(function () {
        Route::get('builder','index');
        Route::get('builder/create','getCreate');
        Route::get('builder/rebuild/{any}','getRebuild');
        Route::get('builder/build/{any}','getBuild');
        Route::get('builder/config/{any}','getConfig');
        Route::get('builder/sql/{any}','getSql');
        Route::get('builder/table/{any}','getTable');
        Route::get('builder/form/{any}','getForm');
        Route::get('builder/formdesign/{any}','getFormdesign');
        Route::get('builder/subform/{any}','getSubform');
        Route::get('builder/subformremove/{any}','getSubformremove');
        Route::get('builder/sub/{any}','getSub');
        Route::get('builder/removesub','getRemovesub');
        Route::get('builder/permission/{any}','getPermission');
        Route::get('builder/source/{any}','getSource');
        Route::get('builder/combotable','getCombotable');
        Route::get('builder/combotablefield','getCombotablefield');
        Route::get('builder/editform/{any?}','getEditform');
        Route::get('builder/destroy/{any?}','getDestroy');
        Route::get('builder/conn/{any?}','getConn');
        Route::get('builder/code/{any?}','getCode');
        Route::get('builder/duplicate/{any?}','getDuplicate');
        Route::get('builder/template/{any}','getTemplate');
        Route::get('builder/preview/{table}','preview');
        Route::get('builder/attach/{table}','attachTemplate');
        /* POST Method */
        Route::post('builder/create','postCreate');
        Route::post('builder/saveconfig/{any}','postSaveconfig');
        Route::post('builder/savesetting/{any}','postSavesetting');
        Route::post('builder/savesql/{any}','postSavesql');
        Route::post('builder/savetable/{any}','postSavetable');
        Route::post('builder/saveform/{any}','postSaveForm');
        Route::post('builder/savesubform/{any}','postSavesubform');
        Route::post('builder/formdesign/{any}','postFormdesign');
        Route::post('builder/savepermission/{any}','postSavePermission');
        Route::post('builder/savesub/{any}','postSaveSub');
        Route::post('builder/dobuild/{any}','postDobuild');
        Route::post('builder/source/{any}','postSource');
        Route::post('builder/install','postInstall');
        Route::post('builder/package','postPackage');
        Route::post('builder/dopackage','postDopackage');
        Route::post('builder/saveformfield/{any?}','postSaveformfield');
        Route::post('builder/conn/{any?}','postConn');
        Route::post('builder/code/{any?}','postCode');
        Route::post('builder/duplicate/{any?}','postDuplicate');
        Route::post('builder/savetemplate/{any?}','savetemplate');
    });
    
});
