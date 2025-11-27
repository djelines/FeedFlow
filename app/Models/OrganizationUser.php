<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HashableId; 


class OrganizationUser extends Model
{
    use HasFactory;
    use HashableId;


    protected $table    = 'organization_user';
    public $timestamps  = true;
    protected $fillable = [ 'id', 'user_id', 'organization_id', 'role', 'created_at', 'updated_at' ];
    protected $casts = [
    ];


    // An organisation has many users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // An organization user belongs to an organization
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    // Get Role of the user in the organization
    public function getRole(){
        return $this->role;
    }

    public function oneUser(){

        return $this -> belongsTo(User::class, 'user_id', 'id');
    }

    public function isUserPresent($organization_id, $user_id){
        return $this->where('organization_id', $organization_id)->where('user_id', $user_id)->exists();
}


}
