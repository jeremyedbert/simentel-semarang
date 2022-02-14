<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Tower;
use App\Models\User;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class FormController extends Controller
{
  public function index()
  {
    $tipemenara = DB::table('tipe_menaras')->get();
    $kecamatan = DB::table('kecamatans')->pluck("name", "id");
    $tipejalan = DB::table('tipe_jalans')->get();
    $tipesite = DB::table('tipe_sites')->get();
    // return dd(response()->json(compact('tipemenara', 'kecamatan', 'tipejalan', 'tipesite')));
    // return response()->json(compact('tipemenara', 'kecamatan', 'tipejalan', 'tipesite'));
    return view('user.form-menara', compact('tipemenara', 'kecamatan', 'tipejalan', 'tipesite'), ['active' => 'pendaftaran']);
  }

  public function getKelurahan(Request $request)
  {
    $kelurahan = DB::table('kelurahans')
      ->where("kecamatan_id", $request->kecamatan_id)
      ->pluck("name", "id");
    return response()->json($kelurahan);
  }

  public function store(Request $request)
  {
    $validatedTower = $request->validate([
      'pemilik' => 'required|max:50',
      'idMenara' => 'required|unique:towers,idMenara',
      'tipe_menara_id' => 'required',
      'tipe_site_id' => 'required',
      'tipe_jalan_id' => 'required',
      'tinggi' => 'required|numeric',
      'kecamatan_id' => 'required',
      'kelurahan_id' => 'required',
      'latitude' => 'required|numeric',
      'longitude' => 'required|numeric',
      'luas' => 'required',
      'operator' => 'nullable',
      'penyewa' => 'nullable',
      'nomorIMB' => 'nullable',
    ],[
      'pemilik.required' => 'Harap isi nama pemilik atau perusahaan.',
      'idMenara.required' => 'Harap isi ID Menara.',
      'idMenara.unique' => 'ID Menara tersebut sudah ada.',
      'tipe_menara_id.required' => 'Harap pilih tipe menara.',
      'tipe_site_id.required' => 'Harap pilih tipe site.',
      'tipe_jalan_id.required' => 'Harap pilih tipe jalan.',
      'tinggi.required' => 'Harap isi tinggi menara.',
      'tinggi.numeric' => 'Isi tinggi menara dengan angka.',
      'kecamatan_id.required' => 'Harap pilih kecamatan.',
      'kelurahan_id.required' => 'Harap pilih kelurahan.',
      'latitude.required' => 'Harap isi latitude.',
      'latitude.numeric' => 'Isi latitude dengan angka.',
      'longitude.required' => 'Harap isi longitude.',
      'longitude.numeric' => 'Isi longitude dengan angka.',
      'luas.required' => 'Harap isi luas menara.'
    ]);

    $config = ['table' => 'pendaftarans', 'length' => 14, 'prefix' => date('ymdH'), 'field' => 'id'];
    $id = IdGenerator::generate($config);

    $tower = new Tower();
    $tower->pemilik = $request->pemilik;
    $tower->idMenara = $request->idMenara;

    $tower->tipe_menara_id = $request->tipe_menara_id;
    $tower->tipe_site_id = $request->tipe_site_id;
    $tower->tipe_jalan_id = $request->tipe_jalan_id;
    $tower->kecamatan_id = $request->kecamatan_id;
    $tower->kelurahan_id = $request->kelurahan_id;

    $tower->tinggi = $request->tinggi;
    $tower->latitude = $request->latitude;
    $tower->longitude = $request->longitude;
    $tower->luas = $request->luas;
    $tower->operator = $request->operator;
    $tower->penyewa = $request->penyewa;
    $tower->nomorIMB = $request->nomorIMB;
    $storeTower = $tower->save();

    $pendaftaran = new Pendaftaran();
    $pendaftaran->id = $id;
    $pendaftaran->user_id = auth()->user()->id;
    $pendaftaran->tower_id = $tower->id;
    $storePendaftaran = $pendaftaran->save();

    if ($storeTower && $storePendaftaran) {
      return redirect(route('user.daftar-menara'))
        ->with('success', 'Pengajuan pendaftaran/izin menara berhasil. Silakan tunggu persetujuan dari kami.');
    } else {
      return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan ulangi lagi.');
    }
  }
}
