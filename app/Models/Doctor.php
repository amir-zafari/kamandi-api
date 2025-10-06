<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
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
}
