<?php

namespace Modules\Survey\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;

class Survey extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'survey_surveys';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'slug', 'bg_header', 'json',
    ];

    protected $casts = [
        'json'  =>  'array',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function results()
    {
        return $this->hasMany(SurveyResult::class, 'survey_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Survey\Database\factories\SurveyFactory::new();
    }
}
