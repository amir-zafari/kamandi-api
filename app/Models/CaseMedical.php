<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseMedical extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'title',
        'case_date',
        'case_medical_type_id',
        'notes',
        'pin'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function type()
    {
        return $this->belongsTo(CaseMedicalType::class, 'case_medical_type_id');
    }

    public function files()
    {
        return $this->hasMany(CaseMedicalFile::class, 'case_medical_id');
    }
}
