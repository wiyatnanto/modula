<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'core_settings';

    protected $fillable = ['setting_name', 'setting_key', 'setting_type', 'setting_type_options','setting_value'];
    
    public function setSetting_NameAttribute($value)
    {
        $this->attributes['setting_name'] = $value;
        $this->attributes['setting_key'] = Str::slug($value);
    }

    protected static function newFactory()
    {
        return \Modules\Core\Database\factories\SettingFactory::new();
    }
}
