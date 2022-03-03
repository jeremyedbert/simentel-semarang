<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users|email:dns',
            'phone' => 'required|unique:users',
            'password' => 'required|min:5',
            'cpassword' => 'required|min:5|same:password',
        ], [
            'cpassword.required' => 'Kolom password konfirmasi wajib diisi.',
            'cpassword.same' => 'Password konfirmasi tidak sesuai.'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user['email_verified_at'] = now();
        $save = $user->save();

        if ($save) {
            return redirect(route('user.login'))->with('success', 'Anda sudah teregistrasi. Silakan masuk.');
            // if (Auth::attempt($credentials)) {
            //     $request->session()->regenerate();
            //     return redirect()->intended('/email/verify');
            // }
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan ulangi lagi.');
        }
    }

    public function edit()
    {
        // return dd(Auth::user());
        return view('user.edit-profil', [
            'data' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email:dns', Rule::unique('users', 'email')->ignore(Auth::user()->id)],
            'name' => 'required',
            'phone' => ['required', Rule::unique('users', 'phone')->ignore(Auth::user()->id)],
            'password' => 'required|min:5',
        ], [
            'email.required' => 'Kolom email wajib diisi.',
            'email.unique' => 'Email sudah dipakai oleh pengguna lain.',
            'email.email' => 'Email tidak sesuai.',
            'name.required' => 'Kolom nama wajib diisi.',
            'phone.required' => 'Kolom nomor handphone wajib diisi.',
            'password.required' => 'Kolom password wajib diisi.',
            'password.min' => 'Password minimal 5 karakter.',
        ]);

        if (Hash::check($validatedData['password'], Auth::user()->getAuthPassword())) {
            if ($request->email === auth()->user()->email) {
                User::find(auth()->user()->id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                ]);
            } else {
                User::find(auth()->user()->id)->update([
                    'email' => $request->email,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    // 'email_verified_at' => NULL,
                ]);
            }
            return back()->with('success', 'Data Anda sudah diperbarui');
        } else {
            return back()->with('error', 'Password tidak sesuai');
        };
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns|exists:users,email',
            'password' => 'required|min:5|max:30'
        ], [
            'email.exists' => 'Email tidak ditemukan.'
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
}
