<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    use RevisionableTrait;
    protected $fillable = [
        'user_id',
        'specialty',
        'code_nzam',
        'work_experience',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }
    public function medicaldocuments()
    {
        return $this->hasMany(CaseMedical::class);
    }
    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
