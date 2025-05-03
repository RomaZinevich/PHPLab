@extends('layouts.app')

@section('content')
    <h1>Створити запис на прийом</h1>
    <form method="POST" action="{{ route('appointments.store') }}">
        @csrf
        <div class="form-group">
            <label for="appointment_date">Дата прийому:</label>
            <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control" required>
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
            <button type="submit" class="btn btn-primary">Записати на прийом</button>
        </div>
    </form>
@endsection
