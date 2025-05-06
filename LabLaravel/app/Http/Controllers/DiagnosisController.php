<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Appointment; // Додаємо модель для прийомів
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function index(Request $request)
    {
        $query = Diagnosis::query();

        if ($request->has('description')) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }

        if ($request->has('appointment_id')) {
            $query->where('appointment_id', $request->appointment_id);
        }

        $diagnoses = $query->with(['appointment'])->paginate($request->input('itemsPerPage', 10));

        $appointments = Appointment::all();

        return view('diagnoses.index', compact('diagnoses', 'appointments'));
    }

    public function create()
    {
        $appointments = Appointment::all();
        return view('diagnoses.create', compact('appointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'description' => 'required|string|max:255',
        ]);

        Diagnosis::create([
            'appointment_id' => $request->appointment_id,
            'description' => $request->description,
        ]);

        return redirect()->route('diagnoses.index');
    }

    public function show($id)
    {
        $diagnosis = Diagnosis::findOrFail($id);
        return view('diagnoses.show', compact('diagnosis'));
    }

    public function edit($id)
    {
        $diagnosis = Diagnosis::findOrFail($id);
        $appointments = Appointment::all();
        return view('diagnoses.edit', compact('diagnosis', 'appointments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'description' => 'required|string|max:255',
        ]);

        $diagnosis = Diagnosis::findOrFail($id);
        $diagnosis->update([
            'appointment_id' => $request->appointment_id,
            'description' => $request->description,
        ]);

        return redirect()->route('diagnoses.index');
    }

    public function destroy($id)
    {
        Diagnosis::findOrFail($id)->delete();
        return redirect()->route('diagnoses.index');
    }
}
