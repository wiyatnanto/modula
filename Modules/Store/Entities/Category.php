<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $table = 'store_categories';

    protected $fillable = [
        'id', 'name', 'slug', 'description', 'parent_id', 'featured', 'menu', 'menu_level', 'order_menu', 'image'
    ];

    protected $casts = [
        'parent_id' =>  'integer',
        'featured'  =>  'boolean',
        'menu'      =>  'boolean'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('order_menu');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'store_product_categories', 'category_id', 'product_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\CategoryFactory::new();
    }
}
