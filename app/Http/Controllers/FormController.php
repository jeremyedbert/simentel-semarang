<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\StoreNotifikasiRequest;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use App\Models\Tower;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Zone;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class FormController extends Controller
{
  public function index()
  {
    $zones = Zone::all();
    $tipemenara = DB::table('tipe_menaras')->get();
    $kecamatan = DB::table('kecamatans')->pluck("name", "id");
    $kelurahan = DB::table('kelurahans')->get();
    $tipejalan = DB::table('tipe_jalans')->get();
    $tipesite = DB::table('tipe_sites')->get();
    // return response()->json($zones);
    // return dd(response()->json(compact('tipemenara', 'kecamatan', 'tipejalan', 'tipesite')));
    // return response()->json(compact('tipemenara', 'kecamatan', 'tipejalan', 'tipesite'));
    return view('user.form-menara', compact('tipemenara', 'kecamatan', 'kelurahan', 'tipejalan', 'tipesite', 'zones'), ['active' => 'pendaftaran']);
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
    // ddd($request);

    // return $request->file('document')->store('documents');
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
      'document' => 'required|mimes:pdf|max:10240',
    ], [
      'pemilik.required' => 'Harap isi nama pemilik atau perusahaan.',
      'idMenara.required' => 'Kolom ID Menara wajib diisi.',
      'idMenara.unique' => 'ID Menara sudah ada.',
      'tipe_menara_id.required' => 'Harap pilih tipe menara.',
      'tipe_site_id.required' => 'Harap pilih tipe site.',
      'tipe_jalan_id.required' => 'Harap pilih tipe jalan.',
      'tinggi.required' => 'Kolom tinggi menara wajib diisi',
      'tinggi.numeric' => 'Isi tinggi menara dengan angka.',
      'kecamatan_id.required' => 'Harap pilih kecamatan.',
      'kelurahan_id.required' => 'Harap pilih kelurahan.',
      'latitude.required' => 'Kolom latitude wajib diisi.',
      'latitude.numeric' => 'Isi latitude dengan angka.',
      'longitude.required' => 'Kolom longitude wajib diisi.',
      'longitude.numeric' => 'Isi longitude dengan angka.',
      'luas.required' => 'Kolom luas menara wajib diisi.',
      'document.required' => 'Anda wajib mengunggah dokumen/surat permohonan.',
      'document.mimes' => 'Dokumen wajib berupa PDF.',
      'document.max' => 'Ukuran maksimum 10 MB.',
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

    $file = $request->file('document');
    // $filename = $request->file('document')->getClientOriginalName();
    $filename = preg_replace('/[^A-Za-z0-9().\-]/', '_', $file->getClientOriginalName());
    //$pendaftaran->document = $file->storeAs('documents/', $filename);
    $file->storeAs('documents/', $filename);
    $pendaftaran->document = $filename;


    $storePendaftaran = $pendaftaran->save();

    $notifikasi = new Notifikasi();
    $notifikasi->pendaftaran_id = $id;
    $storeNotifikasi = $notifikasi->save();

    if ($storeTower && $storePendaftaran && $storeNotifikasi) {
      return redirect(route('user.daftar-menara'))
        ->with('success', 'Pengajuan pendaftaran/izin menara berhasil. Silakan tunggu persetujuan dari kami. 
        Anda dapat melihat status pendaftaran di halaman <a href="/user/cekstatus"><b>Cek Status Permohonan</b></a>');
    } else {
      return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan ulangi lagi.');
    }
  }

  // public function upload(Request $request)
  // {
  //   if ($request->hasFile('document')) {
  //     $file = $request->file('document');
  //     $filename = 'docs-'.$request->idMenara;
  //     $folder = $request->idMenara;
  //     $filepath = "path:'documents/tmp'";
  //     $file->storeAs('tmp/'.$folder);
  //     $request->file('document')->store('tmp/');
  //     $request->file('document')->store('tmp/');

  //     return $folder;
  //   }

  //   // return '';
  // }
}