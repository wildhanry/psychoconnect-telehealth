<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JanjiTemu extends Model
{
    protected $fillable = [
        'pasien_id',
        'psikolog_id',
        'schedule_date',
        'schedule_time',
        'status',
        'meeting_link',
        'notes',
    ];

    protected $casts = [
        'schedule_date' => 'date',
        'schedule_time' => 'datetime:H:i',
    ];

    /**
     * Relationship: Appointment belongs to User (as patient)
     */
    public function pasien()
    {
        return $this->belongsTo(User::class, 'pasien_id');
    }

    /**
     * Relationship: Appointment belongs to User (as psychologist)
     */
    public function psikolog()
    {
        return $this->belongsTo(User::class, 'psikolog_id');
    }
}
