<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    use HasFactory;

    protected $table    = 'survey_questions';
    public $timestamps  = true;
    protected $fillable = [
        'id', 'survey_id',
        'title', 'question_type', 'options',
        'created_at', 'updated_at'
    ];

    // Cast 'options' to array
    protected $casts = [
        'options' => 'array',
    ];

    // A survey question belongs to a survey
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function answers()
    {
        return $this->hasMany(SurveyAnswer::class, 'survey_question_id');
    }

    // Get the organization ID of the survey this question belongs to
    public function getSurveyOrganizationId()
    {
        return $this->survey->organization_id;
    }
}
