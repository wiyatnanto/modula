<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'store_product_attributes';

    protected $fillable = ['product_id', 'attribute_id', 'value_id', 'sku', 'quantity', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\ProductAttributeFactory::new();
    }
}
