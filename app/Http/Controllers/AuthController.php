<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public $auth = Auth::class;

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
    public function store(Request $request, User $user, Auth $auth, Profile $profile)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|max:250|unique:users,email',
            'password' => 'required|min:8',
            'umur' => 'required',
            'bio' => 'required|min:10',
            'alamat' => 'required|min:10',
        ]);
        
        // insert data profile
        $profile->bio       = $request->bio;
        $profile->alamat    = $request->alamat;        
        $profile->umur      = $request->umur;
        $profile->save();
        
        // insert data user
        $user::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'profile_id'    => $profile->id,
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    // login form
    public function login()
    {
        return view('auth.login');
    }

    // auth proses login
    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return redirect()->back()->withErrors([
            'email' => 'email atau password tidak ditemukan',
        ])->onlyInput('email');
        
    }

    // logout proses
    public function logout(Request $request, Auth $auth)
    {
        $auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }

    // dasboard page
    public function dashboard(Auth $auth)
    {
        if ($auth::check())
        {
            return view('auth.dashboard');
        }

        return redirect()->route('auth.login');
    }
}
