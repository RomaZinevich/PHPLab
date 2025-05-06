<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware(function ($request, $next) {
            $user = auth()->user();

            $restrictedRoutes = ['newProductForm', 'store', 'editProductForm', 'update', 'destroy'];
            if (in_array($request->route()->getActionMethod(), $restrictedRoutes)) {
                if (!$user->isManager() && !$user->isAdmin()) {
                    abort(403, 'Access denied');
                }
            }

            return $next($request);
        });
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
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

        $product = new Product();
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->user_id = Auth::id();
        $product->save();

        return redirect()->route('products.index');
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return view('products.show', ['product' => $product]);
    }

    public function editProductForm($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return view('products.edit', ['product' => $product]);
    }

    // Оновлення продукту
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:1000',
        ]);

        $product->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'description' => $data['description'],
        ]);

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $product->delete();

        return redirect()->route('products.index');
    }
}

