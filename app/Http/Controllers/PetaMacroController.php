<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\TipeSite;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetaMacroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $towerMakro = Tower::
                      where('tipe_menara_id', 1)  
                      ->whereNotNull('acc_date')
                      ->searching()
                      ->filter(request(['kecamatan_id','kelurahan_id']))
                      ->get();

        $tabelMakro = Tower::
                      where('tipe_menara_id', 1)  
                      ->whereNotNull('acc_date')
                      ->searching()
                      ->filter(request(['kecamatan_id','kelurahan_id']))
                      ->paginate(30)
                      ->withQueryString();
                      // ->get();

        // $chartMakro = Tower::
        //               where('tipe_menara_id', 1)
        //               ->whereNotNull('acc_date')
        //               ->get();

        $chartMakro = Tower::
                      selectRaw('kecamatan_id, COUNT(kecamatan_id) as jumlah')
                      ->groupBy('kecamatan_id')
                      ->where('tipe_menara_id', 1)
                      ->whereNotNull('acc_date')
                      ->get();

        $kecamatan = DB::table('kecamatans')->pluck("name", "id");
        $kelurahan = DB::table('kelurahans')->pluck("name", "id");
        $tipesite = TipeSite::all()->pluck('name', 'id');
        $zones = Zone::filter(request(['kecamatan_id']))->get();

        // return response()->json($chartMakro);
        // return response()->json($kecamatan);
        // return response()->json($kec);
        
  
        return view('user.peta-menara', 
                    compact(
                      'towerMakro', 
                      'tabelMakro',
                      'chartMakro',
                      'kecamatan', 
                      'kelurahan',
                      'tipesite', 
                      'zones'),
                      ['active' => 'peta']
                    );
      
    }

    public function getKelurahan(Request $request)
    {
      $kelurahan = DB::table('kelurahans')
        ->where("kecamatan_id","=", $request->kecamatan_id)
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function show(Tower $tower)
    {
        //
        $zones = Zone::all();
        return view('user.detail-menara', [
          'data' => $tower,
          ], compact('zones')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function edit(Tower $tower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tower $tower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tower  $tower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tower $tower)
    {
        //
    }
}