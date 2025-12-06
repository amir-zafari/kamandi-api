<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    use RevisionableTrait;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'user_id',
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
        'canceled_by',
        'canceled_at',
        'cancel_reason',
        'marked_attended_by',
        'arrival_time',
        'visit_start_time',
        'attendance_notes',
        'waiting_time',
    ];

    protected $casts = [
        'canceled_at' => 'datetime',
        'arrival_time' => 'datetime',
        'visit_start_time' => 'datetime',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function canceledBy()
    {
        return $this->belongsTo(User::class, 'canceled_by');
    }

    public function markedAttendedBy()
    {
        return $this->belongsTo(User::class, 'marked_attended_by');
    }

    /**
     * بررسی اینکه آیا نوبت قابل لغو است یا خیر
     */
    public function isCancelable()
    {
        // نوبت‌های لغو شده، ویزیت شده قابل لغو نیستند
        if (in_array($this->status, ['canceled', 'visited'])) {
            return false;
        }

        // نوبت‌هایی که ویزیت تکمیل شده قابل لغو نیستند
        if ($this->attended === 'completed') {
            return false;
        }

        // نوبت‌های گذشته قابل لغو نیستند
        $appointmentDateTime = strtotime($this->date . ' ' . $this->start_time);
        if ($appointmentDateTime < time()) {
            return false;
        }

        return true;
    }

    /**
     * بررسی اینکه آیا نوبت قابل ویرایش است یا خیر
     */
    public function isEditable()
    {
        // نوبت‌های لغو شده و ویزیت شده قابل ویرایش نیستند
        if (in_array($this->status, ['canceled', 'visited'])) {
            return false;
        }

        // نوبت‌هایی که ویزیت تکمیل شده قابل ویرایش نیستند
        if ($this->attended === 'completed') {
            return false;
        }

        return true;
    }

    /**
     * بررسی اینکه آیا می‌توان حضور را ثبت کرد
     */
    public function canMarkAttended()
    {
        // فقط نوبت‌های در حال انتظار قابل ثبت حضور هستند
        if ($this->status !== 'waiting') {
            return false;
        }

        if ($this->attended === 'completed') {
            return false;
        }

        return true;
    }

    /**
     * بررسی اینکه آیا می‌توان ویزیت را شروع کرد
     */
    public function canStartVisit()
    {
        return $this->attended === 'arrived' && $this->status === 'waiting';
    }

    /**
     * محاسبه زمان انتظار
     */
    public function calculateWaitingTime()
    {
        if ($this->arrival_time && $this->visit_start_time) {
            $diff = $this->visit_start_time->diffInMinutes($this->arrival_time);
            $this->waiting_time = $diff;
            return $diff;
        }
        return null;
    }

    /**
     * دریافت وضعیت حضور به فارسی
     */
    public function getAttendedStatusLabel()
    {
        $labels = [
            'not_arrived' => 'حضور نیافته',
            'arrived' => 'حاضر شده',
            'completed' => 'ویزیت تکمیل شده',
        ];

        return $labels[$this->attended] ?? 'نامشخص';
    }
}
