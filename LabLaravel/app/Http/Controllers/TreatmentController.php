<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Diagnose;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Treatment::with('diagnose');

        if ($request->has('name') && $request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $treatments = $query->paginate($request->get('itemsPerPage', 10));

        return view('treatments.index', compact('treatments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'instructions' => 'nullable|string',
            'diagnosis_id' => 'required|exists:diagnoses,id',
            'description' => 'nullable|string',
        ]);

        $treatment = Treatment::create([
            'name' => $request->name,
            'instructions' => $request->instructions,
            'diagnosis_id' => $request->diagnosis_id,
            'description' => $request->description,
        ]);

        return redirect()->route('treatments.index')->with('success', 'Лікування створено');
    }

    public function show($id)
    {
        // Завантажуємо Treatment по ID разом з діагнозом
        $treatment = Treatment::with('diagnose')->findOrFail($id);
        return response()->json($treatment);
    }

    public function create()
    {
        // Отримуємо всі діагнози для випадаючого списку
        $diagnoses = Diagnose::all();

        return view('treatments.create', compact('diagnoses'));
    }

    public function update(Request $request, $id)
    {
        $treatment = Treatment::findOrFail($id);

        // Валідні дані для оновлення Treatment
        $request->validate([
            'name' => 'required|string|max:255',
            'instructions' => 'nullable|string',
            'diagnosis_id' => 'required|exists:diagnoses,id',  // Перевірка на існування діагнозу
            'description' => 'nullable|string',
        ]);

        $treatment->update([
            'name' => $request->name,
            'instructions' => $request->instructions,
            'diagnosis_id' => $request->diagnosis_id,
            'description' => $request->description,
        ]);

        return redirect()->route('treatments.index')->with('success', 'Лікування оновлено');
    }

    public function destroy($id)
    {
        // Видаляємо Treatment по ID
        $treatment = Treatment::findOrFail($id);
        $treatment->delete();

        return redirect()->route('treatments.index')->with('success', 'Лікування видалено');
    }
}
