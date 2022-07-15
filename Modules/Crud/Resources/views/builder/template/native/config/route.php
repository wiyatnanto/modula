<?php
    $val .= "
// Start Routes for ".$row->module_name." 
use App\Http\Controllers\{$controller};
Route::resource('{$class}','{$controller}');
Route::post('{$class}','{$controller}@index');
// End Routes for ".$row->module_name." 
"; 
?>                    