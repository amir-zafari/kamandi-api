<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseMedicalFile extends Model
{
    protected $fillable = [
        'case_medical_id', 'file_path', 'file_name', 'format', 'size'
    ];

    public function caseMedical()
    {
        return $this->belongsTo(CaseMedical::class);
    }
}
