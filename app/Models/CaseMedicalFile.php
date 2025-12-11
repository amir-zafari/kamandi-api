<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class CaseMedicalFile extends Model
{
    use RevisionableTrait;
    protected $fillable = [
        'case_medical_id', 'file_path', 'file_name', 'format', 'size'
    ];

    public function caseMedical()
    {
        return $this->belongsTo(CaseMedical::class);
    }
}
