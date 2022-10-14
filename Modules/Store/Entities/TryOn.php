<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TryOn extends Model
{
    use HasFactory;

    protected $table = 'store_product_tryons';

    protected $fillable = ['product_id', 'type', '3D_config_json', 'image_config_json'];

    protected $casts = [
        'product_id'    =>  'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\TyrOnFactory::new();
    }
}
