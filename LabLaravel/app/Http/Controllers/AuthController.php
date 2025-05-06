<?php

namespace App\Http\Controllers;

use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user_products,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = UserProduct::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect()->route('products.index');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('products.index');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']], true)) {
            return redirect()->route('products.index');
        }

        return redirect()->back()->with('error', 'The provided credentials are incorrect.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

}
