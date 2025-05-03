@extends('layouts.app')

@section('content')
    <h1>Список призначень</h1>

    <a href="{{ route('appointments.create') }}" class="btn btn-primary">Створити нове призначення</a>

    <table class="table">
        <thead>
        <tr>
            <th>Пацієнт</th>
            <th>Лікар</th>
            <th>Дата призначення</th>
            <th>Опис</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</td>
                <td>{{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}</td>
                <td>{{ $appointment->appointment_date }}</td>
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
@endsection
