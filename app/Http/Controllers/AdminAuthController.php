<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            // CEK APAKAH DIA ADMIN
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return back()->with('error', 'Akun ini bukan admin!');
            }

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }
}
