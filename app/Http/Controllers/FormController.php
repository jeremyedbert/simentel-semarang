<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Tower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class FormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tipemenara = DB::table('tipe_menaras')->get();
        $kecamatan = DB::table('kecamatans')->pluck("name", "id");
        $tipejalan = DB::table('tipe_jalans')->get();
        $tipesite = DB::table('tipe_sites')->get();
        return view('user.form-menara', compact('tipemenara', 'kecamatan', 'tipejalan', 'tipesite'), ['active' => 'pendaftaran']);
    }

    public function getKelurahan(Request $request)
    {
      $kelurahan = DB::table('kelurahans')
        ->where("kecamatan_id", $request->kecamatan_id)
        ->pluck("name", "id");
      return response()->json($kelurahan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $validatedTower = $request->validate([
          'pemilik' => 'required|max:50',
          'idMenara' => 'required|unique',
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
        ]);

        $config = ['table' => 'pendaftarans', 'length' => 14, 'prefix' => date('ymdH'), 'field' => 'id'];
        $id = IdGenerator::generate($config);

        // $pendaftaran = $request->validate([
        //   'document' => 'nullable|file|max:10240',
        // ]);

        $pendaftaran['id'] = $id;
        $pendaftaran['user_id'] = auth()->user()->id;
        $pendaftaran['tower_id'] = $this->create($validatedTower)->id;

        Tower::create($validatedTower);
        Pendaftaran::create($pendaftaran);

        // if ($saveTower && $savePendaftaran) {
          return redirect(route('user.daftar-menara'))->with('success', 'Pengajuan pendaftaran/izin menara berhasil. 
                Silakan tunggu persetujuan dari kami.');
        // } else {
        //   return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan ulangi lagi.');
        // }

        // $tower = new Tower();
        // $tower->pemilik = $request->pemilik;
        // $tower->idMenara = $request->idMenara;

        // $tower->tipe_menara_id = $request->tipeMenara;
        // $tower->tipe_site_id = $request->tipeSite;
        // $tower->tipe_jalan_id = $request->tipeJalan;
        // $tower->kecamatan_id = $request->kecamatan;
        // $tower->kelurahan_id = $request->kelurahan;

        // $tower->tinggi = $request->tinggi;
        // $tower->latitude = $request->latitude;
        // $tower->longitude = $request->longitude;
        // $tower->luas = $request->luas;
        // $tower->operator = $request->operator;
        // $tower->penyewa = $request->penyewa;
        // $tower->nomorIMB = $request->nomorIMB;
        // $saveTower = $tower->save();

        // $pendaftaran = new Pendaftaran();
        // $pendaftaran->id = $id;
        // $pendaftaran->user_id = auth()->user()->id;
        // $pendaftaran->tower_id = $tower->id;
        // $savePendaftaran = $pendaftaran->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        //
    }
}
