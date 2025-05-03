@extends('layouts.app')

@section('content')
    <h1>Список лікувань</h1>

    <a href="{{ route('treatments.create') }}" class="btn btn-primary">Створити нове лікування</a>

    <table class="table">
        <thead>
        <tr>
            <th>Пацієнт</th>
            <th>Лікар</th>
            <th>Опис лікування</th>
            <th>Дата початку</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach($treatments as $treatment)
            <tr>
                <td>{{ $treatment->patient->first_name }} {{ $treatment->patient->last_name }}</td>
                <td>{{ $treatment->doctor->first_name }} {{ $treatment->doctor->last_name }}</td>
                <td>{{ $treatment->treatment_description }}</td>
                <td>{{ $treatment->start_date }}</td>
                <td>
                    <a href="{{ route('treatments.show', $treatment->id) }}" class="btn btn-info">Переглянути</a>
                    <a href="{{ route('treatments.edit', $treatment->id) }}" class="btn btn-warning">Редагувати</a>
                    <form action="{{ route('treatments.destroy', $treatment->id) }}" method="POST" style="display:inline;">
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
