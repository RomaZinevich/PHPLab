@extends('layouts.app1')

@section('content')
    <div class="container">
        <h2>Редагувати продукт</h2>
        <form method="POST" action="{{ route('products.update', $product->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Назва продукту</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="form-group">
                <label for="price">Ціна</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Опис</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Оновити продукт</button>
        </form>
    </div>
@endsection
