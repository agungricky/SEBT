<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function Authenticate(Request $request)
    {
        $credential = $request->only('username', 'password');

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        } else {
            return back()->with('gagal', 'Password atau username salah');
        }
    }
}
