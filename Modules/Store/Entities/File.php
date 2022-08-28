<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;

    protected $table = 'store_product_files';

    protected $fillable = ['product_id', 'file_category', 'file'];

    protected $casts = [
        'product_id'    =>  'integer',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\FileFactory::new();
    }
}
