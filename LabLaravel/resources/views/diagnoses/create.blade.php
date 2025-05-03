@extends('layouts.app')

@section('content')
    <h1>Створити новий діагноз</h1>
    <form method="POST" action="{{ route('diagnoses.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Назва діагнозу:</label>
            <input type="text" name="diagnosis_name" id="name" class="form-control" required>
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
            <label for="date">Дата постановки діагнозу:</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Зберегти діагноз</button>
        </div>
    </form>
@endsection
