<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BranchImage extends Model
{
    use HasFactory;

    protected $table = 'store_branch_images';

    protected $fillable = ['branch_id', 'image', 'address', 'coordinate', 'main_image', 'order_image'];

    protected $casts = [
        'branch_id'    =>  'integer',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\BranchImageFactory::new();
    }
}
