<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.welcome');
    }

    public function list(){
        return view('admin.list');
    }

    public function history(){
        return view('admin.history');
    }
}
