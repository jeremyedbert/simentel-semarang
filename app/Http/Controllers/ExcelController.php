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
use Carbon\Carbon;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class ExcelController extends Controller
{
    public function index()
    {
        $kecamatan = Kecamatan::all();
        // return dd($kecamatan);
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
            'datepicker' => 'required|date',
            'datepicker2' => 'required|date|after_or_equal:datepicker'
        ], [
            'daftar.required' => 'Pilih minimal 1 kecamatan.',
            'tipeMenara.required' => 'Tipe menara wajib dipilih.',
            'datepicker.required' => 'Tanggal awal wajib diisi.',
            'datepicker2.required' => 'Tanggal akhir wajib diisi.',
            'datepicker2.after_or_equal' => 'Tanggal akhir harus setelah atau sama dengan tanggal awal.'
        ]);

        // Request Input
        $startDate = Carbon::parse($request->input('datepicker'));
        $endDate = Carbon::parse($request->input('datepicker2'));
        $startDateFormatted = $startDate->format('Y-m-d');
        $endDateFormatted = $endDate->format('Y-m-d');

        $tipe = $request->input('tipeMenara');
        $kecamatan = $request->input('daftar');
        $daftar_tower = array();

        foreach ($kecamatan as $kec) {
            $tower = Tower::select('id')->where('kecamatan_id', $kec)->get();
            array_push($daftar_tower, $tower);
        }
        
        // flatten array
        $new_array = array();
        for($i = 0; $i < count($daftar_tower); $i++){
            for($j = 0; $j < count($daftar_tower[$i]); $j++){
                array_push($new_array, $daftar_tower[$i][$j]->id);
            }
        }

        // Nama file
        if ($tipe == 5) {
            $nama_tipe = 'all';
        } else if ($tipe == 1) {
            $nama_tipe = 'makro';
        } else {
            $nama_tipe = 'mikro';
        }
        $tanggal_awal = $startDate->format('Ymd');
        $tanggal_akhir = $endDate->format('Ymd');
        $fileName = $nama_tipe . '_' . $startDateFormatted . '_' . $endDateFormatted . '.xlsx';
        return Excel::download(new TowerExport($startDateFormatted, $endDateFormatted, $tipe, $new_array), $fileName);
    }

    // public function towerExport()
    // {
    //     return Excel::download(new TowerExport, 'tower.xlsx');
    // }
}
