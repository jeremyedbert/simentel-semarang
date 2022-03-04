<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns|exists:admins,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => 'Email tidak ditemukan.',
            'email.email' => 'Email tidak sesuai.',
            'email.required' => 'Harap mengisi kolom email.',
            'password.required' => 'Harap mengisi kolom password.',
            'password.min' => 'Password minimal 5 karakter.',
            'password.max' => 'Password maksimal 30 karakter.'
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->with('loginError', 'Login gagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
