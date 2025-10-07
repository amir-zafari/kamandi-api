<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'appointment_id',
        'visit_date',
        'notes',
        'diagnosis',
        'follow_up_date',
    ];

    public function record()
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id');
    }

    public function appointment()
    {
        return $this->belongsTo(\App\Models\Appointment::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function labTests()
    {
        return $this->hasMany(LabTest::class);
    }
}
