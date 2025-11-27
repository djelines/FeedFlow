<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    use HasFactory;

    protected $table    = 'survey_answers';
    public $timestamps  = true;
    protected $fillable = [
        'id', 'survey_id', 'survey_question_id', 'user_id',
        'answer',
        'created_at', 'updated_at'
    ];
    protected $casts = [
    ];

    // A survey answer belongs to a survey
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    // A survey answer belongs to a survey question
    public function surveyQuestion()
    {
        return $this->belongsTo(SurveyQuestion::class);
    }

    // A survey answer belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeCountMonthlyAnswers(Builder $query){

        $month = Carbon::now()->month;

        return $query->whereMonth('survey_answers.created_at', $month)->count();
    }
}
