<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'patient_id',
        'doctor_id',
        'specialization',
        'appointment_time',
        'status',
        'type',
        'reason',
        'notes'
    ];

    protected $casts = [
        'appointment_time' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Each appointment can have one billing record.
     */
    public function billing()
    {
        return $this->hasOne(\App\Models\Billing::class, 'appointment_id');
    }

    // Helper: Check if appointment is in the future
    public function getIsUpcomingAttribute()
    {
        return $this->appointment_time && $this->appointment_time->isFuture();
    }
}
