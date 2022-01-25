<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.welcome', [
            'active' => 'dashboard',
            
        ]);
    }

    public function history(){
        return view('admin.history', [
            'active' => 'history'
        ]);
    }
}
