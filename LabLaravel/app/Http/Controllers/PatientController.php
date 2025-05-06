<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->filled('name')) {
            $query->where('first_name', 'like', '%' . $request->input('name') . '%')
                ->orWhere('last_name', 'like', '%' . $request->input('name') . '%');
        }

        $doctors = $query->paginate($request->input('itemsPerPage', 10));

        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        // Валідація для збереження нового пацієнта
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:10',
            'phone' => 'nullable|string|max:20',
        ]);

        // Створення пацієнта
        Patient::create($request->all());

        return redirect()->route('patients.index');
    }

    public function show($id)
    {
        // Показати інформацію про конкретного пацієнта
        $patient = Patient::findOrFail($id);
        return view('patients.show', compact('patient'));
    }

    public function edit($id)
    {
        // Редагування даних пацієнта
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, $id)
    {
        // Валідація при оновленні даних пацієнта
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|string|max:10',
            'phone' => 'nullable|string|max:20',
        ]);

        // Оновлення даних пацієнта
        $patient = Patient::findOrFail($id);
        $patient->update($request->all());

        return redirect()->route('patients.index');
    }

    public function destroy($id)
    {
        // Видалення пацієнта
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('patients.index');
    }
}
