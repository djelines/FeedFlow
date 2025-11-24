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
        return $this->hasManyThrough(Organization::class, OrganizationUser::class, 'user_id', 'id', 'id', 'organization_id');
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
    
}
