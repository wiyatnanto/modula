<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Str;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'store_brands';

    protected $fillable = ['name', 'slug', 'logo'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\BrandFactory::new();
    }
}
