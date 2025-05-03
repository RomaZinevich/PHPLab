@extends('layouts.app')

@section('content')
    <h1>Створити нового лікаря</h1>
    <form method="POST" action="{{ route('doctors.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Ім'я лікаря:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="specialty">Спеціальність:</label>
            <input type="text" name="specialty" id="specialty" class="form-control" required>
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
