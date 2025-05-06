@extends('layouts.app')

@section('content')
    <h1>Створити нового лікаря</h1>
    <form method="POST" action="{{ route('doctors.store') }}">
        @csrf
        <div class="form-group">
            <label for="first_name">Ім'я лікаря:</label>
            <input type="text" name="first_name" id="first_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="last_name">Прізвище лікаря:</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="specialization">Спеціалізація:</label>
            <input type="text" name="specialization" id="specialization" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="text" name="phone" id="phone" class="form-control">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Зберегти лікаря</button>
        </div>
    </form>
@endsection
