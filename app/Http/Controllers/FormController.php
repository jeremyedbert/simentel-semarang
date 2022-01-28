<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Tower;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Persetujuan;
use DB;

class FormController extends Controller
{
    public function index()
    {
      $tipemenara = DB::table('tipe_menaras')->get();
      $kecamatan = DB::table('kecamatans')->pluck("name", "id");
      $tipejalan = DB::table('tipe_jalans')->get();
      $tipesite = DB::table('tipe_sites')->get();
      return view('user.form-menara', compact('tipemenara','kecamatan', 'tipejalan', 'tipesite'), ['active' => 'pendaftaran']);
    }

    public function getKelurahan(Request $request)
    {
      $kelurahan = DB::table('kelurahans')
                    ->where("idKec", $request->idKec)
                    ->pluck("name", "id"); 
      return response()->json($kelurahan);
    }

    public function createTower(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users|email:dns',
        //     'phone' => 'required|unique:users',
        //     'password' => 'required|min:5|max:30',
        //     'cpassword' => 'required|min:5|max:30|same:password',
        // ], [
        //     'cpassword.required' => 'Confirmation password is required.',
        //     'cpassword.same' => 'Your password confirmation does not match.'
        // ]);

        $tower = new Tower();
        $tower->pemilik = $request->pemilik;
        $tower->idMenara = $request->idMenara;
        $tower->idTipeMenara = $request->tipeMenara;
        $tower->idSite = $request->tipeSite;
        $tower->idJalan = $request->tipeJalan;
        $tower->tinggi = $request->tinggi;
        $tower->idKec = $request->kecamatan;
        $tower->idKel = $request->kelurahan;
        $tower->latitude = $request->latitude;
        $tower->longitude = $request->longitude;
        $tower->luas = $request->luas;
        $tower->operator = $request->operator;
        $tower->penyewa = $request->penyewa;
        $tower->nomorIMB = $request->nomorIMB;
        $saveTower = $tower->save();

        $pendaftaran = new Pendaftaran();
        $pendaftaran->id = '500500';
        $pendaftaran->idUser = auth()->user()->id;
        $pendaftaran->idTower = $tower->id;
        $savePendaftaran = $pendaftaran->save();

        $persetujuan = new Persetujuan();
        $persetujuan->id = '500500';
        $persetujuan->idStatus = 1;
        $savePersetujuan = $persetujuan->save();

        if ($saveTower && $savePendaftaran && $savePersetujuan) {
            return redirect(route('user.daftar-menara'))->with('success', 'Pengajuan pendaftaran/izin menara berhasil. 
            Silakan tunggu persetujuan dari kami.');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan ulangi lagi.');
        }
    }

}
