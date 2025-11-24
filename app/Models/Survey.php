<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    
}
