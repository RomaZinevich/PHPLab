<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        return view('patients.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:10',
            'phone' => 'nullable|string|max:20',
            'doctors' => 'nullable|array',
        ]);

        $patient = Patient::create($request->all());

        if ($request->has('doctors')) {
            $patient->doctors()->sync($request->doctors);
        }

        return redirect()->route('patients.index');
    }

    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.show', compact('patient'));
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        $doctors = Doctor::all();
        return view('patients.edit', compact('patient', 'doctors'));
    }

    // Обновляем данные пациента
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:10',
            'phone' => 'nullable|string|max:20',
            'doctors' => 'nullable|array',
        ]);

        $patient = Patient::findOrFail($id);
        $patient->update($request->all());

        if ($request->has('doctors')) {
            $patient->doctors()->sync($request->doctors);
        }

        return redirect()->route('patients.index');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('patients.index');
    }
}
