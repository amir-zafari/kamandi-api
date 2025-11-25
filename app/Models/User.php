<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'national_id',
        'gender',
        'roll',
        'code',
        'code_expires_at'
    ];

    protected $hidden = [
//        'code',
        'code_expires_at'
    ];


    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patient_user');
    }

}
