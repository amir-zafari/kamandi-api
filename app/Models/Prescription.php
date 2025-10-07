<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'visit_id',
        'medication_name',
        'dosage',
        'instructions',
        'duration_days',
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

    public function record()
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id');
    }
}
