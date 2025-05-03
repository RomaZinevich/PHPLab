@extends('layouts.app')

@section('content')
    <h1>Список діагнозів</h1>

    <a href="{{ route('diagnoses.create') }}" class="btn btn-primary">Створити новий діагноз</a>

    <table class="table">
        <thead>
        <tr>
            <th>Пацієнт</th>
            <th>Діагноз</th>
            <th>Дата постановки</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach($diagnoses as $diagnosis)
            <tr>
                <td>{{ $diagnosis->patient->first_name }} {{ $diagnosis->patient->last_name }}</td>
                <td>{{ $diagnosis->diagnosis_name }}</td>
                <td>{{ $diagnosis->date }}</td>
                <td>
                    <a href="{{ route('diagnoses.show', $diagnosis->id) }}" class="btn btn-info">Переглянути</a>
                    <a href="{{ route('diagnoses.edit', $diagnosis->id) }}" class="btn btn-warning">Редагувати</a>
                    <form action="{{ route('diagnoses.destroy', $diagnosis->id) }}" method="POST" style="display:inline;">
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
