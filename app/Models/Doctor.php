<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'qualification',
        'specialization',
        'department',
        'profile_photo',
        'address',
        'date_of_joining',
        'experience',
        'is_available',
        'room_number',
        'timing',
        'consultation_fee',
        'bio',
        'license_number',
        'created_by',
        'updated_by'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
