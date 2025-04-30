<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'invoice_number',
        'items',
        'subtotal',
        'tax',
        'discount',
        'total',
        'status',
        'payment_method',
        'paid_at',
        'due_date',
        'description'
    ];
    
    protected $casts = [
        'items' => 'array',
        'paid_at' => 'date',
        'due_date' => 'date',
    ];
    
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
