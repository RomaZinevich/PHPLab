<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;
    protected $fillable = ['appointment_id', 'description'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function patient()
    {
        return $this->belongsToThrough(Patient::class, Appointment::class);
    }

    public function doctor()
    {
        return $this->belongsToThrough(Doctor::class, Appointment::class);
    }
}
