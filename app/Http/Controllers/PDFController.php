<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    public function index()
    {
        return view('admin.cetak', [
            'notif' => Notifikasi::orderBy('mark_as_read', 'asc')->get(),
            'countNotif' => DB::table('notifikasis')
                ->join('pendaftarans', 'notifikasis.pendaftaran_id', '=', 'pendaftarans.id')
                ->whereNull('mark_as_read')->where('pendaftarans.status_id', 1)
                ->count()
        ]);
    }

    public function downloadPDF(){
        
    }
}
