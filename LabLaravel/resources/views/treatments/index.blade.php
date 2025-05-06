@extends('layouts.app')

@section('content')
    <h1>Список лікувань</h1>

    <a href="{{ route('treatments.create') }}" class="btn btn-primary mb-3">Створити нове лікування</a>

    <form method="GET" action="{{ route('treatments.index') }}" class="mb-3">
        <input type="text" name="name" placeholder="Пошук по назві лікування" value="{{ request('name') }}" class="form-control" />
        <input type="number" name="itemsPerPage" placeholder="Кількість на сторінці" value="{{ request('itemsPerPage', 10) }}" class="form-control mt-2" />
        <button type="submit" class="btn btn-secondary mt-2">Пошук</button>
    </form>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Назва лікування</th>
            <th>Інструкції</th>
            <th>Діагноз</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        @forelse($treatments as $treatment)
            <tr>
                <td>{{ $treatment->name }}</td>
                <td>{{ $treatment->instructions }}</td>
                <td>{{ $treatment->diagnose->name ?? 'Немає' }}</td>
                <td>
                    <a href="{{ route('treatments.edit', $treatment->id) }}" class="btn btn-warning btn-sm">Редагувати</a>
                    <form action="{{ route('treatments.destroy', $treatment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Ви впевнені?')">Видалити</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4">Немає записів</td></tr>
        @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $treatments->appends(request()->query())->links('pagination::bootstrap-4') }}
    </div>
@endsection
