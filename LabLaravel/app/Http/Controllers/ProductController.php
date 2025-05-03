<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Статичний масив продуктів для тестування (без підключення до бази даних)
    private static array $products = [];
    private static int $nextId = 1;

    public function __construct()
    {
        if (empty(self::$products)) {
            self::$products = [
                1 => ['id' => 1, 'name' => 'Laptop', 'price' => 999.99, 'description' => 'High-performance laptop'],
                2 => ['id' => 2, 'name' => 'Smartphone', 'price' => 599.99, 'description' => 'Latest model'],
                3 => ['id' => 3, 'name' => 'Headphones', 'price' => 199.99, 'description' => 'Wireless headphones'],
            ];
            self::$nextId = 4;
        }
    }

    // Показати всі продукти
    public function index()
    {
        return view('products.index', ['products' => self::$products]);
    }
    public function newProductForm()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
        ]);

        $product = [
            'id' => self::$nextId++,
            'name' => $data['name'],
            'price' => (float)$data['price'],
            'description' => $data['description']
        ];

        self::$products[$product['id']] = $product;

        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = $this->findProductById($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return view('products.show', ['product' => $product]);
    }

    public function editProductForm($id)
    {
        $product = $this->findProductById($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = $this->findProductById($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
        ]);

        self::$products[$id] = [
            'id' => $id,
            'name' => $data['name'],
            'price' => (float)$data['price'],
            'description' => $data['description']
        ];

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = $this->findProductById($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        unset(self::$products[$id]);

        return redirect()->route('products.index');
    }

    private function findProductById($id)
    {
        return self::$products[$id] ?? null;
    }
}
