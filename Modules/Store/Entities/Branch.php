<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Support\Str;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'store_branches';

    protected $fillable = [];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function images()
    {
        return $this->hasMany(BranchImage::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\BranchFactory::new();
    }
}
