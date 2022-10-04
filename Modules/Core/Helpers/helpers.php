<?php
  
use Modules\Core\Entities\MenuItem;
use Modules\Core\Entities\Setting;
use Illuminate\Support\Facades\Cache;

/**
 * Write code on Method
 *
 * @return response()
 */
if (! function_exists('getMenu')) {
    function getMenu($name)
    {
        return MenuItem::with('children')->where('menu_id', 2)->orderBy('sort_order')->get();
    }
}

if (! function_exists('setting')) {
    function setting($key)
    {
        $setting = Cache::rememberForever('setting', function() use($key) {
            return Setting::where('setting_key', $key)->first();
        });
        return $setting->setting_value;
    }
}
