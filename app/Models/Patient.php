<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    use RevisionableTrait;
    protected $fillable = [
        'first_name',
        'last_name',
        'national_id',
        'gender',
        'birth_date',
        'blood_type',
        'allergies',
        'chronic_diseases',
        'notes',
        'emergency_contact',
        'address',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'patient_user');
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
    public function specialAppointment()
    {
        return $this->hasOne(Appointment::class)
            ->whereIn('status', ['no_show', 'waiting']);
    }
}
