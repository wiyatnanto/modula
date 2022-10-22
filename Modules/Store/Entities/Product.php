<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $table = "store_products";

    protected $fillable = [
        "brand_id",
        "sku",
        "name",
        "slug",
        "description",
        "quantity",
        "weight",
        "length",
        "width",
        "height",
        "price",
        "sale_price",
        "status",
        "featured",
    ];

    protected $casts = [
        "quantity" => "integer",
        "brand_id" => "integer",
        "status" => "boolean",
        "featured" => "boolean",
    ];

    public function setNameAttribute($value)
    {
        $this->attributes["name"] = $value;
        $this->attributes["slug"] = Str::slug($value);
    }

    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            "store_product_categories",
            "product_id",
            "category_id"
        );
    }

    public function storefronts()
    {
        return $this->belongsToMany(
            StoreFront::class,
            "store_product_storefronts",
            "product_id",
            "storefront_id"
        );
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function main_image()
    {
        return $this->images()->first();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function variantOptions()
    {
        return $this->belongsToMany(
            VariantOption::class,
            "store_product_variant_options",
            "product_id",
            "variant_id"
        );
    }

    public function variantValues()
    {
        return $this->belongsToMany(
            VariantValue::class,
            "store_product_variant_values",
            "product_id",
            "value_id"
        );
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function files()
    {
        return $this->hasOne(File::class);
    }

    public function tryon()
    {
        return $this->hasOne(TryOn::class);
    }

    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\ProductFactory::new();
    }
}
