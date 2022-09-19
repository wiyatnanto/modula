<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog_categories';

    protected $fillable = [];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function SubCategories()
    {
        return $this->hasMany(Category::class,'parent_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\CategoryFactory::new();
    }
}
