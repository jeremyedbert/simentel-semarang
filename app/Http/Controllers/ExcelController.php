<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Notifikasi;
use App\Models\TipeMenara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exports\TowerExport;
use App\Models\Tower;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function index()
    {
        return view('admin.export-excel', [
            'kecamatan' => Kecamatan::all(),
            'tipeMenara' => TipeMenara::all(),
            'notif' => Notifikasi::orderBy('mark_as_read', 'asc')->get(),
            'countNotif' => DB::table('notifikasis')
                ->join('pendaftarans', 'notifikasis.pendaftaran_id', '=', 'pendaftarans.id')
                ->whereNull('mark_as_read')->where('pendaftarans.status_id', 1)
                ->count()
        ]);
    }

    public function towerExport(Request $request)
    {
        $validatedData = $request->validate([
            'daftar' => 'required',
            'tipeMenara' => 'required',
        ], [
            'daftar.required' => 'Pilih minimal 1 kecamatan.',
            'tipeMenara.required' => 'Tipe menara wajib dipilih.'
        ]);

        $tipe = $request->input('tipeMenara');
        $kecamatan = $request->input('daftar');
        $daftar_tower = array();

        foreach($kecamatan as $kec){
            $tower = Tower::select('id')->where('kecamatan_id', $kec)->get();
            array_push($daftar_tower, $tower);
        }

        // return dd($tipe);
        // return $daftar_tower;

        return Excel::download(new TowerExport($tipe), 'tower.xlsx');
    }

    // public function towerExport()
    // {
    //     return Excel::download(new TowerExport, 'tower.xlsx');
    // }
}
