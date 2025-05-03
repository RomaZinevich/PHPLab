@extends('layouts.app')

@section('content')
    <h1>Створити нове лікування</h1>
    <form method="POST" action="{{ route('treatments.store') }}">
        @csrf
        <div class="form-group">
            <label for="treatment_name">Назва лікування:</label>
            <input type="text" name="treatment_name" id="treatment_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="treatment_description">Опис лікування:</label>
            <textarea name="treatment_description" id="treatment_description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="patient_id">Пацієнт:</label>
            <select name="patient_id" id="patient_id" class="form-control" required>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->first_name }} {{ $patient->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="doctor_id">Лікар:</label>
            <select name="doctor_id" id="doctor_id" class="form-control" required>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->first_name }} {{ $doctor->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Зберегти лікування</button>
        </div>
    </form>
@endsection
