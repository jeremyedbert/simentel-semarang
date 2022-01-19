<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users|email:dns',
            'phone' => 'required|unique:users',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password',
        ],[
            'cpassword.same' => 'Your password confirmation does not match.'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if($save){
            return redirect(route('user.login'))->with('success','Anda sudah teregistrasi. Silakan masuk.');
        } else{
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan ulangi lagi.');
        }
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
