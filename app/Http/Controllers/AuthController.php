<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Masmerise\Toaster\Toaster;
use App\Models\User;

class AuthController extends Controller
{

    // Handle Registration
    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        Auth::login($user);

        Toaster::success('Registration Successful!');


        return redirect()->route('home');
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            Toaster::success('Login Successful!');

            if (Auth::user()->role === 'admin') {
                return redirect('/admin');
            }

            return redirect()->route('home');

        }

        Toaster::error('Invalid Credentials!');

        return back();
    }

    // Handle Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Toaster::success('Logout Successful!');

        return redirect()->route('home');
    }
}
