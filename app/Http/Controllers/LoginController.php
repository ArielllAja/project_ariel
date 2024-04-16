<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login.login');
    }

    public function postlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('error' , 'Email atau password salah');
    }

    public function logout () {
        Auth::logout();
        return redirect('/');
    }
}
