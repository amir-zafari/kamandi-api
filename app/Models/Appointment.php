<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'date',
        'start_time',
        'attended',
    ];

    // ارتباط با دکتر
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // ارتباط با بیمار
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
