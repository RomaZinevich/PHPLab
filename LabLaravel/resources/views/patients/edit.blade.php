@extends('layouts.app')

@section('content')
    <h1>Редагувати пацієнта</h1>

    <form action="{{ route('patients.update', $patient->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="first_name">Ім'я</label>
            <input type="text" name="first_name" id="first_name" value="{{ $patient->first_name }}" required>
        </div>
        <div>
            <label for="last_name">Прізвище</label>
            <input type="text" name="last_name" id="last_name" value="{{ $patient->last_name }}" required>
        </div>
        <div>
            <label for="birth_date">Дата народження</label>
            <input type="date" name="birth_date" id="birth_date" value="{{ $patient->birth_date }}" required>
        </div>
        <div>
            <label for="gender">Стать</label>
            <select name="gender" id="gender">
                <option value="male" {{ $patient->gender == 'male' ? 'selected' : '' }}>Чоловік</option>
                <option value="female" {{ $patient->gender == 'female' ? 'selected' : '' }}>Жінка</option>
            </select>
        </div>
        <div>
            <label for="phone">Телефон</label>
            <input type="text" name="phone" id="phone" value="{{ $patient->phone }}">
        </div>
        <div>
            <label for="doctors">Лікарі</label>
            <select name="doctors[]" id="doctors" multiple>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}"
                        {{ $patient->doctors->contains($doctor->id) ? 'selected' : '' }}>
                        {{ $doctor->first_name }} {{ $doctor->last_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Оновити</button>
    </form>
@endsection
