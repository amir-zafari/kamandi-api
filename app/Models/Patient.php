<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'for_type',
        'first_name',
        'last_name',
        'national_id',
        'phone',
        'birth_date',
        'gender',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
