@extends('layouts.app')

@section('content')
    <h1>Створити нового пацієнта</h1>

    <form action="{{ route('patients.store') }}" method="POST">
        @csrf
        <div>
            <label for="first_name">Ім'я</label>
            <input type="text" name="first_name" id="first_name" required>
        </div>
        <div>
            <label for="last_name">Прізвище</label>
            <input type="text" name="last_name" id="last_name" required>
        </div>
        <div>
            <label for="birth_date">Дата народження</label>
            <input type="date" name="birth_date" id="birth_date" required>
        </div>
        <div>
            <label for="gender">Стать</label>
            <select name="gender" id="gender">
                <option value="male">Чоловік</option>
                <option value="female">Жінка</option>
            </select>
        </div>
        <div>
            <label for="phone">Телефон</label>
            <input type="text" name="phone" id="phone">
        </div>
        <button type="submit">Зберегти</button>
    </form>
@endsection
