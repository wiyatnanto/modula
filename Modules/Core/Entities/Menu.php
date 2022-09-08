<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'core_menus';

    protected $fillable = ['*'];

    protected $casts = [
        'parent_id'  =>  'integer',
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('sort_order');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Site\Database\factories\MenuFactory::new();
    }
}
