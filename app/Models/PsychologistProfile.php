<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PsychologistProfile extends Model
{
    protected $fillable = [
        'user_id',
        'specialization',
        'bio',
        'str_number',
        'is_verified',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    /**
     * Relationship: Profile belongs to User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
