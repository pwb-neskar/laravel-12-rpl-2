<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    // register form
    public function register()
    {
        return view('auth.register');
    }

    // store register
    public function store(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|max:250|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    // login form
    public function login()
    {

    }

    // auth proses login
    public function auth(Request $request)
    {

    }

    // logout proses
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }

    // dasboard page
    public function dashboard()
    {
        return view('auth.dashboard');
    }
}
