<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
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

    // Returns whether the user has a specific role in the selected organization.
    public function hasRoleInOrganization(string $role, Organization $organization): bool{
        return !is_null(
            $this->organizations()
                ->where("organization_id", $organization->id)
                ->wherePivot('role', $role)
                ->first()
        );
    }

    // An user has many survey answers
    public function surveyAnswers()
    {
        return $this->hasMany(SurveyAnswer::class);
    }

    // An user has many surveys
    public function surveys()
    {
        return $this->hasMany(Survey::class);
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

}
