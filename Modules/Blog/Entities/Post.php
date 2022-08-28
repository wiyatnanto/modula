<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';

    protected $fillable = ['title', 'content', 'slug', 'status', 'featured_image', 'caption', 'published_at', 'user_id'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function Categories()
    {
        return $this->morphToMany(Category::class,'categoryable');
    }

    public function Tags()
    {
        return $this->morphToMany(Tag::class,'taggable');
    }

    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    //attribute
    public function getMinContentAttribute()
    {
        return mb_strimwidth($this->content,0,200,"...");
    }

    public function getLinkAttribute()
    {
        return $this->created_at->format('Y/m/d/').$this->slug;
    }
    
    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\PostFactory::new();
    }
}
