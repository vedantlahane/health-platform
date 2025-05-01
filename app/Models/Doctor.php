<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
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
        'updated_by',
        'status',
    ];

    protected $casts = [
        'date_of_joining' => 'date',
        'is_available' => 'boolean',
        'consultation_fee' => 'float',
    ];

    // Relationships
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // Example: Helper for full specialization string
    public function getFullSpecializationAttribute()
    {
        return trim($this->specialization . ' ' . $this->department);
    }
}
