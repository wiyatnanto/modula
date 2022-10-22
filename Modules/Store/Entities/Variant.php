<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variant extends Model
{
    use HasFactory;

    protected $table = 'store_product_variants';

    protected $fillable = ['variant_values','unique_id','sku','quantity', 'weight', 'price', 'sale_price', 'status'];
    
    protected $casts = [
        'product_id'    =>  'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\VariantFactory::new();
    }
}
