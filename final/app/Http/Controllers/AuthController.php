<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function showSignin()
    {
        return view('signin');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        // Simple authentication - in production, use Laravel's built-in auth
        $defaultUser = [
            'name' => 'Aliza',
            'email' => 'aliza@example.com',
            'password' => '123456'
        ];

        if ($request->name === $defaultUser['name'] && 
            $request->email === $defaultUser['email'] && 
            $request->password === $defaultUser['password']) {
            Session::put('user', $defaultUser);
            return redirect()->route('home')->with('success', 'Welcome back!');
        }

        return back()->with('error', 'Invalid credentials!');
    }

    public function showAdminLogin()
    {
        return view('admin');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($request->username === 'admin' && $request->password === 'admin123') {
            Session::put('adminLoggedIn', true);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid username or password!');
    }

    public function adminLogout()
    {
        Session::forget('adminLoggedIn');
        return redirect()->route('login');
    }

    public function logout()
    {
        Session::forget('user');
        return redirect()->route('login')->with('success', 'You have been logged out successfully!');
    }
}