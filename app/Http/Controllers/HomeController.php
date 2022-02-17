<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.welcome',[
            
        ]);
    }
}