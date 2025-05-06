@extends('layouts.app')

@section('content')
    <h1>Список діагнозів</h1>

    <!-- Форма фільтрації -->
    <form method="get" class="mb-4">
        <input type="text" name="description" placeholder="Пошук по діагнозу" value="{{ request('description') }}">

        <select name="appointment_id" class="form-control">
            <option value="">Прийом</option>
            @foreach($appointments as $appointment)
                <option value="{{ $appointment->id }}" {{ request('appointment_id') == $appointment->id ? 'selected' : '' }}>
                    {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }} - {{ $appointment->doctor->first_name }} {{ $appointment->doctor->last_name }}
                </option>
            @endforeach
        </select>

        <input type="number" name="itemsPerPage" placeholder="Items per page" value="{{ request('itemsPerPage', 10) }}">
        <button type="submit">Фільтрувати</button>
    </form>

    <a href="{{ route('diagnoses.create') }}" class="btn btn-primary">Створити новий діагноз</a>

    <table class="table">
        <thead>
        <tr>
            <th>Пацієнт</th>
            <th>Лікар</th>
            <th>Діагноз</th>
            <th>Дата постановки</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach($diagnoses as $diagnosis)
            <tr>
                <td>{{ $diagnosis->appointment->patient->first_name }} {{ $diagnosis->appointment->patient->last_name }}</td>
                <td>{{ $diagnosis->appointment->doctor->first_name }} {{ $diagnosis->appointment->doctor->last_name }}</td>
                <td>{{ $diagnosis->description }}</td>
                <td>{{ $diagnosis->created_at }}</td>
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

    <div class="d-flex justify-content-center">
        {{ $diagnoses->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
@endsection
