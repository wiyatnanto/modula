<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'core_menus';

    protected $fillable = ['*'];

    protected $casts = [];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }

    protected static function newFactory()
    {
        return \Modules\Site\Database\factories\MenuFactory::new();
    }
}
