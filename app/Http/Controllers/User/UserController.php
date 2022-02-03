<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users|email:dns',
            'phone' => 'required|unique:users',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password',
        ], [
            'cpassword.required' => 'Confirmation password is required.',
            'cpassword.same' => 'Your password confirmation does not match.'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            return redirect(route('user.login'))->with('success', 'Anda sudah teregistrasi. Silakan masuk.');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan ulangi lagi.');
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns|exists:users,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => "We can't find your email."
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }


        return back()->with('loginError', 'Login gagal!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function peta_menara()
    {
        return view('user.peta-menara', [
            'active' => 'peta',
        ]);
    }

    public function peta_microcell()
    {
        return view('user.peta-microcell', [
            'active' => 'peta',
        ]);
    }

    // public function cekStatus(Request $request)
    // {
    //     return view('user.cek-status',[
    //         'active' => 'none',
    //     ]);
    // }
}
