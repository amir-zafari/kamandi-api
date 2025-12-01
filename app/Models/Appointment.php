<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'date',
        'start_time',
        'attended',
        'appointment_type',
        'service_type',
        'status',
        'payment_status',
        'payment_method',
        'transaction_id',
        'payment_info',
        'customer_ip',
        'customer_user_agent',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
