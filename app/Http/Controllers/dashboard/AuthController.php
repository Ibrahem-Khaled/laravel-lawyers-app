<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            return redirect()->intended('home.dashboard');
        } else {
            return redirect()->back()->with('error', 'البريد الالكتروني او كلمة المرور غير صحيحة');
        }
    }


    public function register()
    {
        return view('Auth.register');
    }


    public function forgetPassword()
    {
        return view('Auth.forgetPassword');
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('home');
    }
}
