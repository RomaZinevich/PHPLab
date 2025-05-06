<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $query = Doctor::query();

        if ($request->filled('name')) {
            $query->where('first_name', 'like', '%' . $request->input('name') . '%')
                ->orWhere('last_name', 'like', '%' . $request->input('name') . '%');
        }

        $doctors = $query->paginate($request->input('itemsPerPage', 10));

        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        Doctor::create($request->all());

        return redirect()->route('doctors.index');
    }

    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctors.show', compact('doctor'));
    }

    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctors.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->all());

        return redirect()->route('doctors.index');
    }

    public function destroy($id)
    {
        Doctor::findOrFail($id)->delete();
        return redirect()->route('doctors.index');
    }
}
