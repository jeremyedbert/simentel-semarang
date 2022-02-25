<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Pendaftaran;
use App\Models\Tower;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // $notif = Notifikasi::whereNull('mark_as_read')->get();
        // return dd($notif);
        return view('admin.welcome', [
            'active' => 'dashboard',
            'apply' => Pendaftaran::all(),
            'acc' => Pendaftaran::where('status_id', '2'),
            'reject' => Pendaftaran::where('status_id', '3'),
            'makro' => Tower::where('tipe_menara_id', '1')->whereNotNull('acc_date'),
            'mikro' => Tower::where('tipe_menara_id', '2')->whereNotNull('acc_date'),
            'notif' => Notifikasi::whereNull('mark_as_read')->get(),
        ]);
    }
}
