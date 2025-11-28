<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Traits\HashableId;


class Organization extends Model
{
    use HashableId;
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

    /**
     * Return all answers from all organizations
     * @return HasManyThrough
     */
    public function answers(): hasManyThrough
    {
        return $this->hasManyThrough(
            SurveyAnswer::class, // Data from the table we want
            Survey::class, // middle table
        'organization_id', // middle fk (surveys)
            'survey_id', // final fk (survey_answsers)
            'id'); // organizations pk
    }

    /**
     * Return if an organization has reached the threshold of answers
     * @return bool
     */
    public function canAnswerSurveyLimit(){
        return $this->answers()->countMonthlyAnswers()< config('freenium.response_limit');
    }

    /**
     * Return if organization is a free plan
     * @return bool
     */
    public function isFreePlan(){
        return $this->plan === "free";
    }

    /**
     * Return if an organization has reached the threshold of active surveys
     * @return bool
     */
    public function canCreateSurveyLimit(){
        return $this->hasMany(Survey::class, "organization_id")->where("is_closed", false)->count() < config('freenium.active_limit');
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
