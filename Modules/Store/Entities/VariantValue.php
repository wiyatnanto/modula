<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VariantValue extends Model
{
    use HasFactory;

    protected $table = 'store_variant_values';

    protected $fillable = ['variant_id', 'value'];

    protected $casts = [
        'variant_id'  =>  'integer',
    ];

    public function variantOption()
    {
        return $this->belongsTo(VariantOption::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\VariantValueFactory::new();
    }
}
