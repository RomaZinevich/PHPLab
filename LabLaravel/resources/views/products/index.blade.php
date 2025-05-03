<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
</head>
<body>
<h1>All Products</h1>

<a href="{{ route('products.create') }}">Create New Product</a>

<ul>
    @foreach($products as $product)
        <li>
            <a href="{{ url('/products/' . $product['id']) }}">{{ $product['name'] }}</a> -
            ${{ number_format($product['price'], 2) }}
            <a href="{{ url('/products/' . $product['id'] . '/edit') }}">Edit</a>
            <form action="{{ url('/products/' . $product['id']) }}" method="POST" style="display:inline;">
                @method('DELETE')
                @csrf
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>
</body>
</html>
