@extends('layouts.app')

@section('content')
    <h1>Список лікарів</h1>

    <a href="{{ route('doctors.create') }}" class="btn btn-primary">Створити нового лікаря</a>

    <table class="table">
        <thead>
        <tr>
            <th>Ім'я</th>
            <th>Прізвище</th>
            <th>Спеціалізація</th>
            <th>Телефон</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach($doctors as $doctor)
            <tr>
                <td>{{ $doctor->first_name }}</td>
                <td>{{ $doctor->last_name }}</td>
                <td>{{ $doctor->specialization }}</td>
                <td>{{ $doctor->phone }}</td>
                <td>
                    <a href="{{ route('doctors.show', $doctor->id) }}" class="btn btn-info">Переглянути</a>
                    <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-warning">Редагувати</a>
                    <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" style="display:inline;">
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
