<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseMedicalType extends Model
{
    use HasFactory;
    use RevisionableTrait;
    protected $fillable = ['name'];

    public function case_medicals()
    {
        return $this->hasMany(CaseMedical::class);
    }
}
