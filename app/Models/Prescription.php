<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Prescription extends Model
{
    use HasFactory;
    use RevisionableTrait;
    protected $fillable = [
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

}
