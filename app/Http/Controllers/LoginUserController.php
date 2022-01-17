<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:applicant')->except('logout');
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
        if(Auth::guard('applicant')->attempt(['email'=>$request->email, "password" => $request->password])){
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login gagal!');
    }
}
