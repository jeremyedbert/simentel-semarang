<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email:dns',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password',
        ]);
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
