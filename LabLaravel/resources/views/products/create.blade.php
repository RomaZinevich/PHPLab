<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
<h1>Create a New Product</h1>

<form action="{{ url('/products') }}" method="POST">
    @csrf

    <label for="name">Product Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" required step="0.01"><br><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea><br><br>

    <button type="submit">Create Product</button>
</form>
</body>
</html>
