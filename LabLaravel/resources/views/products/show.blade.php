@extends('layouts.app1')

@section('content')
    <div class="container">
        <h2>Продукт: {{ $product->name }}</h2>

        <p><strong>Ціна:</strong> {{ $product->price }}</p>
        <p><strong>Опис:</strong> {{ $product->description }}</p>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">До списку продуктів</a>
    </div>
@endsection
