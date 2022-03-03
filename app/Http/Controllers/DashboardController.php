<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Pendaftaran;
use App\Models\Tower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'notif' => Notifikasi::orderBy('mark_as_read', 'asc')->get(),
            'countNotif' => DB::table('notifikasis')
                ->join('pendaftarans', 'notifikasis.pendaftaran_id', '=', 'pendaftarans.id')
                ->whereNull('mark_as_read')->where('pendaftarans.status_id', 1)
                ->count()
        ]);
    }
}
