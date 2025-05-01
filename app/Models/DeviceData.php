<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeviceData extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'patient_id',
        'appointment_id',
        'device_type',
        'data',
        'unit',
        'recorded_at',
        'notes',
        'is_billable',
        'billed',
        'billed_in_invoice_id'
    ];

    protected $casts = [
        'data' => 'array',
        'recorded_at' => 'datetime',
        'is_billable' => 'boolean',
        'billed' => 'boolean',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function billing()
    {
        return $this->belongsTo(Billing::class, 'billed_in_invoice_id');
    }
}
