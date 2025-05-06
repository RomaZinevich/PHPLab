@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Список призначень</h1>

        <!-- Форма для фільтрації -->
        <form method="get" class="mb-4">
            <input type="text" name="patient" placeholder="Пошук по пацієнту" value="{{ request('patient') }}">
            <input type="text" name="doctor" placeholder="Пошук по лікарю" value="{{ request('doctor') }}">
            <input type="number" name="itemsPerPage" placeholder="Items per page" value="{{ request('itemsPerPage', 10) }}">
            <button type="submit">Фільтрувати</button>
        </form>

        <a href="{{ route('appointments.create') }}" class="btn btn-primary mb-3">Створити нове призначення</a>

        <table class="table">
            <thead>
            <tr>
                <th>Пацієнт</th>
                <th>Лікар</th>
                <th>Час прийому</th>
                <th>Опис</th>
                <th>Дії</th>
            </tr>
            </thead>
            <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</td>
                    <td>{{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}</td>
                    <td>{{ $appointment->appointment_time }}</td>
                    <td>{{ $appointment->description }}</td>
                    <td>
                        <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-info">Переглянути</a>
                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning">Редагувати</a>
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{-- Пагінація --}}
        <div class="d-flex justify-content-center">
            {{ $appointments->withQueryString()->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
