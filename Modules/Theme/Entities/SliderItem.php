<?php

namespace Modules\Theme\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SliderItem extends Model
{
    use HasFactory;

    protected $table = "theme_slider_items";

    protected $fillable = ["*"];

    public function slider()
    {
        return $this->belongsTo(Slider::class, "slider_id");
    }

    protected static function newFactory()
    {
        return \Modules\Theme\Database\factories\SliderItemFactory::new();
    }
}
