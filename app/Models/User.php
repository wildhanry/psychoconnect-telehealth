<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
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

    /**
     * Relationship: User has one Psychologist Profile
     */
    public function psychologistProfile()
    {
        return $this->hasOne(PsychologistProfile::class);
    }

    /**
     * Relationship: User (psychologist) has many schedules
     */
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    /**
     * Relationship: User (patient) has many appointments as patient
     */
    public function appointmentsAsPasien()
    {
        return $this->hasMany(JanjiTemu::class, 'pasien_id');
    }

    /**
     * Relationship: User (psychologist) has many appointments as psychologist
     */
    public function appointmentsAsPsikolog()
    {
        return $this->hasMany(JanjiTemu::class, 'psikolog_id');
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is psychologist
     */
    public function isPsikolog()
    {
        return $this->role === 'psikolog';
    }

    /**
     * Check if user is patient
     */
    public function isPasien()
    {
        return $this->role === 'pasien';
    }
}
