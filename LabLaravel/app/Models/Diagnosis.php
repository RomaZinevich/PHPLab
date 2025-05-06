<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;
    protected $fillable = ['appointment_id', 'description'];

    // Відношення до прийому (Appointment)
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    // Якщо вам потрібен доступ до пацієнта через прийом
    public function patient()
    {
        return $this->belongsToThrough(Patient::class, Appointment::class);
    }

    // Якщо вам потрібен доступ до лікаря через прийом
    public function doctor()
    {
        return $this->belongsToThrough(Doctor::class, Appointment::class);
    }
}
