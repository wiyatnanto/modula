<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TyrOn extends Model
{
    use HasFactory;

    protected $table = 'store_product_tryons';

    protected $fillable = ['*'];

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
