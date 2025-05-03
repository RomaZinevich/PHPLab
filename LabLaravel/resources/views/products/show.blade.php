<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product['name'] }}</title>
</head>
<body>
<h1>{{ $product['name'] }}</h1>
<p>Price: ${{ number_format($product['price'], 2) }}</p>
<p>Description: {{ $product['description'] }}</p>

<a href="{{ route('products.index') }}">Back to Product List</a>
</body>
</html>
