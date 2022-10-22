<?php

namespace Modules\Theme\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'theme_sliders';

    protected $fillable = [];
    
    protected $casts = [];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function items()
    {
        return $this->hasMany(SliderItem::class);
    }

    protected static function newFactory()
    {
        return \Modules\Theme\Database\factories\SliderFactory::new();
    }
}
