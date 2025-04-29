<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'dob',
        'gender',
        'medical_history'
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function deviceData()
    {
        return $this->hasMany(DeviceData::class);
    }

    public function billings()
    {
        return $this->hasMany(Billing::class);
    }
}
