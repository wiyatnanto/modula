<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'store_product_attributes';

    protected $fillable = ['attribute_id', 'product_id', 'value', 'quantity', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\ProductAttributeFactory::new();
    }
}
