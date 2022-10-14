<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Str;

class VariantOption extends Model
{
    use HasFactory;

    protected $table = 'store_variant_options';

    protected $fillable = [
        'product_id', 'code', 'name', 'frontend_type', 'is_filterable', 'is_required'
    ];

    protected $casts  = [
        'is_filterable' =>  'boolean',
        'is_required'   =>  'boolean',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['code'] = Str::slug($value);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variantValues()
    {
        return $this->hasMany(VariantValue::class, 'variant_id');
        
    }

    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\AttributeOptionFactory::new();
    }
}
