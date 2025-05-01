<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'phone',
        'dob',
        'gender',
        'blood_group',
        'address',
        'allergies',
        'medications',
        'family_history',
        'social_history',
        'emergency_contact',
        'insurance',
        'medical_history',
        'status',
        'notes',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    // Relationships
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

    public function reports()
    {
        // Assuming you will have a Report model/table
        return $this->hasMany(Report::class);
    }


protected static function booted()
{
    static::creating(function ($patient) {
        if (empty($patient->uuid)) {
            $patient->uuid = (string) Str::uuid();
        }
    });
}

    // Accessor for latest visit (from appointments)
    public function getLastVisitAttribute()
    {
        return $this->appointments()->latest('appointment_time')->value('appointment_time');
    }
}
