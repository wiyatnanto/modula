<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromoBanner extends Model
{
    use HasFactory;

    protected $table = "store_promo_banners";

    protected $fillable = ["*"];

    // public function setNameAttribute($value)
    // {
    //     $this->attributes['name'] = $value;
    //     $this->attributes['slug'] = Str::slug($value);
    // }

    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\PromoBannerFactory::new();
    }
}
