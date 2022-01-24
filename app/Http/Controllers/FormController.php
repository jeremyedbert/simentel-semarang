<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

class FormController extends Controller
{
    public function index()
    {
      $kecamatan = DB::table('kecamatans')->pluck("name", "id");
      $tipejalan = DB::table('tipe_jalans')->get();
      $tipesite = DB::table('tipe_sites')->get();
      return view('user.form-menara', compact('kecamatan', 'tipejalan', 'tipesite'), ['active' => 'pendaftaran']);
    }

    public function getKelurahan(Request $request)
    {
      $kelurahan = DB::table('kelurahans')
                    ->where("idKec", $request->idKec)
                    ->pluck("name", "id"); 
      return response()->json($kelurahan);
    }

}
