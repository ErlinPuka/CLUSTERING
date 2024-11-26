<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\FuncCall;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\user;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{

    function showLoginForm()
    {
        return view('login');
    }

    function showRegisterForm()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Proses autentikasi menggunakan tabel 'users'
        if (Auth::attempt($credentials)) {
            // Jika sukses login, redirect ke dashboard
            return redirect()->intended('dashboard');
        }

        // Jika gagal, kembalikan ke halaman login dengan input email
        return redirect()->back()->withInput($request->only('email'))->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public Function register (Request $request)
    {
        user::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'  => Hash::make($request->password),
        ]);
        Alert::success("Success", "Data berhasil disimpan");

        return redirect("login");

        
    }

    public Function logout (Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
