<?php

namespace Modules\Survey\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SurveyResult extends Model
{
    use HasFactory;

    protected $table = 'survey_results';
    protected $fillable = [
        'survey_id', 'user_id', 'ip_address', 'json',
    ];
    protected $casts = [
        'json'  =>  'array',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class, 'survey_id');
    }

    
    protected static function newFactory()
    {
        return \Modules\Survey\Database\factories\SurveyResultFactory::new();
    }
}
