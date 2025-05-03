<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('appointments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        // Валідація вводу
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        Appointment::create([
            'appointment_date' => $request->appointment_date,
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'description' => $request->description,
        ]);

        return redirect()->route('appointments.index');
    }

    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return view('appointments.show', compact('appointment'));
    }

    // Показати форму для редагування запису
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));  // Передаємо в представлення
    }

    // Оновити інформацію про прийом
    public function update(Request $request, $id)
    {
        // Валідація вводу
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        // Знаходимо існуючий запис прийому
        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'appointment_date' => $request->appointment_date,
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'description' => $request->description,
        ]);

        return redirect()->route('appointments.index');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('appointments.index');
    }
}
