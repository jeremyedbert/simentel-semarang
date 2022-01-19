<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('user.login', [
            'active' => 'login',
        ]);
    }

    public function authenticate(Request $request)
    {
        // dd($request->all());
        $credentials = $request->validate([
            'email' => 'required|email:dns|exists:users,email',
            'password' => 'required|min:5|max:30'
        ],[
            'email.exists' => "We can't find your email."
        ]);

        // if (Auth::guard('applicant')->attempt($credentials)) {
        //     $request->session()->regenerate();

        //     return redirect()->intended('/');
        // }

        // return back()->with('loginError', 'Login failed!');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }


        return back()->with('loginError', 'Login gagal!');

        // $this->validate()
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
