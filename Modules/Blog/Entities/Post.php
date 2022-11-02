<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "blog_posts";

    protected $fillable = [
        "title",
        "content",
        "slug",
        "status",
        "featured_image",
        "caption",
        "published_at",
        "user_id",
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes["title"] = $value;
        $this->attributes["slug"] = Str::slug($value);
    }

    public function category()
    {
        return $this->belongsToMany(
            Category::class,
            "blog_post_categories",
            "post_id",
            "category_id"
        );
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            "blog_post_tags",
            "post_id",
            "tag_id"
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function minContent()
    {
        return mb_strimwidth($this->content, 0, 200, "...");
    }

    public function getLinkAttribute()
    {
        return $this->created_at->format("Y/m/d/") . $this->slug;
    }

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\PostFactory::new();
    }
}
