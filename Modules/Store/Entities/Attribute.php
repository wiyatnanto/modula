<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Str;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'store_attributes';

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

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\AttributeFactory::new();
    }
}
