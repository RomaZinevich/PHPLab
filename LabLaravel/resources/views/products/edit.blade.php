<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
<h1>Edit Product</h1>

<form action="{{ url('/products/' . $product['id']) }}" method="POST">
    @method('PUT')
    @csrf

    <label for="name">Product Name:</label>
    <input type="text" id="name" name="name" value="{{ $product['name'] }}" required><br><br>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" value="{{ $product['price'] }}" required step="0.01"><br><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required>{{ $product['description'] }}</textarea><br><br>

    <button type="submit">Update Product</button>
</form>
</body>
</html>
