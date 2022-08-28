<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'store_wishlists';
    
    protected $fillable = ['user_id','product_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'store_wishlists', 'user_id', 'product_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\WishlistFactory::new();
    }
}
