<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceData extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'device_type',
        'data',
        'unit',
        'recorded_at',
        'notes'
    ];
    
    protected $casts = [
        'data' => 'array',
        'recorded_at' => 'datetime',
    ];
    
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
