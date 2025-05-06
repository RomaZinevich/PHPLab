@extends('layouts.app')

@section('content')
    <h1>Створити нове лікування</h1>

    <form method="POST" action="{{ route('treatments.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Назва лікування:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="instructions">Інструкції:</label>
            <textarea name="instructions" id="instructions" class="form-control" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="diagnosis_id">Діагноз:</label>
            <select name="diagnosis_id" id="diagnosis_id" class="form-control" required>
                @foreach($diagnoses as $diagnosis)
                    <option value="{{ $diagnosis->id }}">{{ $diagnosis->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Опис:</label>
            <textarea name="description" id="description" class="form-control" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
@endsection
