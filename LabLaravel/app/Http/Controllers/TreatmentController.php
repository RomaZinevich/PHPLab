<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::all();
        return view('treatments.index', compact('treatments'));
    }

    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('treatments.create', compact('patients', 'doctors')); // Передаємо лікарів у шаблон
    }

    public function store(Request $request)
    {
        $request->validate([
            'treatment_name' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
        ]);

        Treatment::create($request->all());

        return redirect()->route('treatments.index');
    }

    public function show($id)
    {
        $treatment = Treatment::findOrFail($id);
        return view('treatments.show', compact('treatment'));
    }

    public function edit($id)
    {
        $treatment = Treatment::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('treatments.edit', compact('treatment', 'patients', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'treatment_name' => 'required|string|max:255',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
        ]);

        $treatment = Treatment::findOrFail($id);
        $treatment->update($request->all());

        return redirect()->route('treatments.index');
    }

    public function destroy($id)
    {
        Treatment::findOrFail($id)->delete();
        return redirect()->route('treatments.index');
    }
}

