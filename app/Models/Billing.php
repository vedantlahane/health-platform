<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'patient_id',
        'appointment_id',
        'invoice_number',
        'items',
        'subtotal',
        'tax',
        'discount',
        'total',
        'payment_method',
        'paid_at',
        'description'
    ];

    protected $casts = [
        'items' => 'array',
        'paid_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
