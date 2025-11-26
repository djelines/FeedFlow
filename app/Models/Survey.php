<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Survey extends Model
{
    use HasFactory;

    protected $table    = 'surveys';
    public $timestamps  = true;
    protected $fillable = [
        'id', 'organization_id', 'user_id',
        'title', 'description', 'start_date', 'end_date', 'is_anonymous',
        'created_at', 'updated_at'
    ];
    protected $casts = [
    ];

    // A survey belongs to an organization
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    // A survey belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A survey has many questions
    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class);
    }

    // Check if the user is the owner of the organization that created the survey
    public function ifUserisOrganizationOwner(User $user, Survey $survey)
    {
        if ($survey->user_id === $user->id) {
            return true;
        }
        return false;
    }

    // Check if the user is the owner or admin for modified/delete
    public function canBeModifiedOrDeletedBy(User $user , Survey $survey)
    {
        if ($user->hasRoleInOrganizationById("admin",$survey->organization_id) || $survey->user_id === $user -> id) {
            return true;
        }
        return false;
    }

    public function isActiveNow(){
        $now = Carbon::now();

        if(is_null($this->start_date)){
            return false;
        }

        return $now->greaterThanOrEqualTo($this->start_date) && (is_null($this->end_date) || $now->lessThanOrEqualTo($this->end_date));
    }

    public function scopeActiveNow(Builder $query) : Builder{

        return $query->where('is_closed', false);
    }

    // A survey has many answer
    public function answers()
    {
        return $this->hasMany(SurveyAnswer::class);
    }

}
