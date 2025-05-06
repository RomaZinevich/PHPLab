@extends('layouts.app1')

@section('content')
    <div class="container">
        <h2>Продукти</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Додати новий продукт</a>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Назва</th>
                <th scope="col">Ціна</th>
                <th scope="col">Дії</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Переглянути</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Редагувати</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
