<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // $notif = Notifikasi::whereNull('mark_as_read')->get();
        // return dd($notif);
        return view('admin.welcome', [
            'active' => 'dashboard',
            'notif' => Notifikasi::whereNull('mark_as_read')->get(),
        ]);
    }
}
