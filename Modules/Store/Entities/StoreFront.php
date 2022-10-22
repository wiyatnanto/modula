<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Str;

class StoreFront extends Model
{
    use HasFactory;

    protected $table = 'store_storefronts';

    protected $fillable = [
        'id', 'name', 'slug', 'order_menu'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'store_product_storefronts', 'storefront_id', 'product_id');
    }

    public function productsWithLimit($limit)
    {
        return $this->hasMany('store_product_storefronts')->take($limit);
    }

    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\StoreFrontFactory::new();
    }
}
