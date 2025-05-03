<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\Patient;
use App\Models\Doctor; // Додаємо модель для лікарів
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function index()
    {
        $diagnoses = Diagnosis::all();
        return view('diagnoses.index', compact('diagnoses'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('diagnoses.create', compact('patients', 'doctors')); // Передаємо лікарів у представлення
    }

    public function store(Request $request)
    {
        $request->validate([
            'diagnosis_name' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
        ]);

        Diagnosis::create($request->all());

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
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('diagnoses.edit', compact('diagnosis', 'patients', 'doctors')); // Передаємо лікарів у представлення
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'diagnosis_name' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
        ]);

        $diagnosis = Diagnosis::findOrFail($id);
        $diagnosis->update($request->all());

        return redirect()->route('diagnoses.index');
    }

    public function destroy($id)
    {
        Diagnosis::findOrFail($id)->delete();
        return redirect()->route('diagnoses.index');
    }
}
