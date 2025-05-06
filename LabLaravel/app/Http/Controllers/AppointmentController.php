<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $itemsPerPage = $request->input('itemsPerPage', 10);  // Отримуємо кількість елементів на сторінку з параметра запиту

        $patientSearch = $request->input('patient', '');
        $doctorSearch = $request->input('doctor', '');

        $appointments = Appointment::with(['patient', 'doctor'])
            ->when($patientSearch, function ($query, $patientSearch) {
                $query->whereHas('patient', function ($query) use ($patientSearch) {
                    $query->where('first_name', 'like', "%{$patientSearch}%")
                        ->orWhere('last_name', 'like', "%{$patientSearch}%");
                });
            })
            ->when($doctorSearch, function ($query, $doctorSearch) {
                $query->whereHas('doctor', function ($query) use ($doctorSearch) {
                    $query->where('first_name', 'like', "%{$doctorSearch}%")
                        ->orWhere('last_name', 'like', "%{$doctorSearch}%");
                });
            })
            ->orderBy('appointment_time', 'desc')
            ->paginate($itemsPerPage);

        return view('appointments.index', compact('appointments', 'patientSearch', 'doctorSearch', 'itemsPerPage'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('appointments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_time' => 'required|date|after_or_equal:now',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        Appointment::create([
            'appointment_time' => $request->appointment_time,
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'description' => $request->description,
        ]);

        return redirect()->route('appointments.index');
    }

    public function show($id)
    {
        $appointment = Appointment::with(['patient', 'doctor'])->findOrFail($id);
        return view('appointments.show', compact('appointment'));
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();

        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'appointment_time' => 'required|date|after_or_equal:now',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'appointment_time' => $request->appointment_time,
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
