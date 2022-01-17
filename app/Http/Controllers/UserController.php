<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
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
