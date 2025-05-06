@extends('layouts.app1')

@section('content')
    <div class="container">
        <h2>Створити новий продукт</h2>
        <form method="POST" action="{{ route('products.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Назва продукту</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="price">Ціна</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Опис</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Створити продукт</button>
        </form>
    </div>
@endsection
