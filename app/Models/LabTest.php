<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'visit_id',
        'test_name',
        'result',
        'file_path',
        'status',
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
