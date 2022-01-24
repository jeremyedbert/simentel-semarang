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
      return view('user.form-menara', compact('kecamatan'), ['active' => 'pendaftaran']);
    }

    public function getKelurahan(Request $request)
    {
      $kelurahan = DB::table('kelurahans')
                    ->where("idKec", $request->idKec)
                    ->pluck("name", "id"); 
      return response()->json($kelurahan);
    }

}
