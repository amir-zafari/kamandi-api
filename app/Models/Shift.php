<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Shift extends Model
{
    use RevisionableTrait;
    protected $fillable = [
        'doctor_id',
        'service_type',
        'day',
        'date',
        'is_recurring',
        'repeat_until',
        'start_time',
        'end_time',
        'duration',
        'capacity_per_slot',
    ];

    // ارتباط با دکتر
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
