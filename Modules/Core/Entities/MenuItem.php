<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuItem extends Model
{
    use HasFactory;

    protected $table = 'core_menu_items';

    protected $fillable = ['*'];

    protected $casts = [
        'parent_id'  =>  'integer',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('sort_order');
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Core\Database\factories\MenuItemFactory::new();
    }
}
