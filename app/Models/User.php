<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HashableId;


class User extends Authenticatable
{
    use HashableId;
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'password',
        'mail_notifications',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // An user has many organization users
    public function organizationUsers()
    {
        return $this->hasMany(OrganizationUser::class);
    }

    // An user belongs to many organizations through organization users
    public function organizations()
    {
        return $this->belongsToMany(Organization::class, "organization_user")
            ->withPivot('role');
    }

    /**
     * return if user is in the specified organization
     * @param $organization_id
     * @return bool
     */
    public function isUserInOrganization($organization_id){
        return $this->organizations()
            ->where('organizations.id', $organization_id)
            ->exists();
    }

    /**
     * Returns whether the user has a specific role in the selected organization.
     * @param string $role
     * @param Organization $organization
     * @return bool
     */
    public function hasRoleInOrganization(string $role, Organization $organization): bool{
        return !is_null(
            $this->organizations()
                ->where("organization_id", $organization->id)
                ->wherePivot('role', $role)
                ->first()
        );
    }

    /**
     * Return if the user has a free plan
     * @return bool
     */
    public function isFreePlan(){
        return $this->plan === "free";
    }


    public function canAnswerSurveyLimit(Organization $organization){
        return $this->hasMany(SurveyAnswer::class , "survey_id")->countMonthlyAnswers() < config('freenium.response_limit');
    }

    /**
     * Return  if the user has a role in a organization by organization id
     * @param string $role
     * @param $organizationId
     * @return bool
     */
    public function hasRoleInOrganizationById(string $role, $organizationId): bool{
        return !is_null(
            $this->organizations()
                ->where("organization_id", $organizationId)
                ->wherePivot('role', $role)
                ->first()
        );
    }


    // An user has many surveys
    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }

    // An user has many survey answers
    public function surveyAnswers(){
        return $this->hasMany(SurveyAnswer::class, 'user_id');
    }

    public function allActiveSurvey(){
        return $this->hasMany(Survey::class)->where('is_closed', false);
    }

    /**
     * Return all the surveys from all organizations
     * @return mixed
     */
    public function allSurveysFromOrganizations()
    {
        return Survey::whereIn(
            'organization_id',
            $this->organizations()->pluck('organizations.id')
        )->get();
    }


    // Get the user's full name
    public function getFullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getByEmail($email): object
    {
        return $this->where('email' , $email)->first();
    }

    public function mailNotificationsEnabled(): bool
    {
        return $this->mail_notifications;
    }

}
