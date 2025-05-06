@extends('layouts.app')

@section('content')
    <h1>Список лікарів</h1>

    <!-- Форма для фільтрації лікарів за ім'ям чи прізвищем -->
    <form method="GET" action="{{ route('doctors.index') }}" class="mb-4">
        <div class="form-group">
            <label for="name">Пошук за іменем чи прізвищем:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}">
        </div>
        <input type="number" name="itemsPerPage" placeholder="Items per page" value="{{ request('itemsPerPage', 10) }}">
        <button type="submit" class="btn btn-primary">Фільтрувати</button>
    </form>

    <a href="{{ route('doctors.create') }}" class="btn btn-primary mb-4">Створити нового лікаря</a>

    <!-- Таблиця лікарів -->
    <table class="table mt-4">
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

    <!-- Пагінація -->
    <div class="d-flex justify-content-center">
        {{ $doctors->withQueryString()->links('pagination::bootstrap-4') }}
    </div>
@endsection
