<?php
  
use Modules\Core\Entities\Menu;

/**
 * Write code on Method
 *
 * @return response()
 */
if (! function_exists('getMenu')) {
    function getMenu($name)
    {
        return Menu::with('children')->where('name', $name)->orderBy('sort_order')->get();
    }
}
