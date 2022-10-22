<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory;

    protected $table = "core_languages";

    protected $fillable = ["*"];

    protected static function newFactory()
    {
        return \Modules\Core\Database\factories\LanguageFactory::new();
    }
}
