<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Tower;
use App\Models\User;
use App\Models\Zone;
// use App\Http\Controllers\Rule;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Storage;
use Storage;

class CekStatusController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('user.cek-status', [
          'data' => Pendaftaran::where('user_id','=',auth()->user()->id)
                                  ->orderBy('status_id')
                                  ->orderBy('created_at', 'desc')
                                  ->get()
        ]);

        // return dd(Pendaftaran::where('user_id','=',auth()->user()->id));
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
        return view('user.detail', 
          ['data' => $pendaftaran]
        );

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
        if($pendaftaran->status->id == 1){
          $zones = Zone::all();
          $tipemenara = DB::table('tipe_menaras')->get();
          $kecamatan = DB::table('kecamatans')->pluck("name", "id");
          $kelurahan = DB::table('kelurahans')->get();
          $tipejalan = DB::table('tipe_jalans')->get();
          $tipesite = DB::table('tipe_sites')->get();
          // return dd($countNotif);
          // return response()->json($pendaftaran);
          return view('user.form-edit', 
            compact(
                    'tipemenara', 
                    'kecamatan', 
                    'kelurahan',
                    'tipejalan', 
                    'tipesite', 
                    'zones', 
                    'pendaftaran'), 
                    ['data' => $pendaftaran]
                  );
          // return dd($pendaftaran);
        }else{
          return redirect("/user/cekstatus/$pendaftaran->id");
        }
        
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
        // return dd($request->kondisi);
      $rulesTower = [
          'pemilik' => 'required|max:50',
          'idMenara' => ['required',Rule::unique('towers','idMenara')->ignore($pendaftaran->tower->id)],
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
      ];

      $rulesPendaftaran = [
        'document' => 'mimes:pdf|max:10240'
        // 'document' => 'required'
      ];

      $validatedTower = $request->validate($rulesTower, [
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
      ]);

      $validatedPendaftaran = $request->validate($rulesPendaftaran,[
        'document.required' => 'Anda wajib mengunggah dokumen/surat permohonan.',
        'document.mimes' => 'Dokumen wajib berupa PDF.',
        'document.max' => 'Ukuran maksimum 10 MB.',
      ]);

      $pendaftaran = Pendaftaran::findOrFail($pendaftaran->id);

      if($request->file('document') != ""){

        //hapus file lama
        //Storage::delete($pendaftaran->document);
        Storage::delete('documents/'.$pendaftaran->document);

        //upload file baru
        $file = $request->file('document');
        $filename = preg_replace('/[^A-Za-z0-9().\-]/', '_', $file->getClientOriginalName());
        $file->storeAs('documents/', $filename);
        $savedPath = 'documents/'.$filename;

        $pendaftaran->update([
          // 'document' => $savedPath
          'document' => $filename
        ]);
      }else{
        $pendaftaran->update();
      }

      //return dd($request);
      // return dd(Pendaftaran::where('id', $pendaftaran->id));

      // Pendaftaran::where('id', $pendaftaran->id)
      //     ->update($validatedPendaftaran);

      // $pendaftaran->update($validatedPendaftaran);

      Tower::where('id', $pendaftaran->tower->id)
          ->update($validatedTower);

      return redirect('/user/cekstatus')->with('success', 'Data ' . $pendaftaran->id . ' berhasil diupdate');
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
