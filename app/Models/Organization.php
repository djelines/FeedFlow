<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Organization extends Model
{
    use HasFactory;

    protected $table    = 'organizations';
    public $timestamps  = true;
    protected $fillable = [ 'id', 'name', 'user_id', 'created_at', 'updated_at', 'plan' ];
    protected $casts = [
    ];

    //An organisation has one user
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->hasMany(OrganizationUser::class);
    }

    public function surveys(): HasMany
    {
        return $this->hasMany(Survey::class);
    }

    public function answers(): hasManyThrough
    {
        return $this->hasManyThrough(
            SurveyAnswer::class, // Data from the table we want
            Survey::class, // middle table
        'organization_id', // middle fk (surveys)
            'survey_id', // final fk (survey_answsers)
            'id'); // organizations pk
    }

    public function canAnswerSurveyLimit(){
        return $this->answers()->countMonthlyAnswers()< config('freenium.response_limit');
    }

    public function isFreePlan(){
        return $this->plan === "free";
    }

    public function canCreateSurveyLimit(){
        return $this->hasMany(Survey::class, "user_id")->activeNow()->count() < config('freenium.active_limit');
    }

    //check if the user can create a surver in a organization
    public function canBeCreateSurvey(User $user): bool
    {
        //check if user = member/admin 
        if ($user->hasRoleInOrganizationById('membre', $this->id) 
            || $user->hasRoleInOrganizationById('admin', $this->id)) {
            return true;
        }
        
        return false;
    }

}
