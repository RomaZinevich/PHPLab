@extends('layouts.app')

@section('content')
    <h1>Пацієнти</h1>

    <a href="{{ route('patients.create') }}" class="btn btn-primary">Створити нового пацієнта</a>

    <table class="table">
        <thead>
        <tr>
            <th>Ім'я</th>
            <th>Прізвище</th>
            <th>Дата народження</th>
            <th>Телефон</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach($patients as $patient)
            <tr>
                <td>{{ $patient->first_name }}</td>
                <td>{{ $patient->last_name }}</td>
                <td>{{ $patient->birth_date }}</td>
                <td>{{ $patient->phone }}</td>
                <td>
                    <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-info">Переглянути</a>
                    <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning">Редагувати</a>
                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
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
