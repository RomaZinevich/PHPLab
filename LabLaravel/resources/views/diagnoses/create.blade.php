@extends('layouts.app')

@section('content')
    <h1>Створити новий діагноз</h1>
    <form method="POST" action="{{ route('diagnoses.store') }}">
        @csrf
        <div class="form-group">
            <label for="appointment_id">Прийом:</label>
            <select name="appointment_id" id="appointment_id" class="form-control" required>
                @foreach($appointments as $appointment)
                    <option value="{{ $appointment->id }}">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }} - {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Опис діагнозу:</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Зберегти діагноз</button>
        </div>
    </form>
@endsection
