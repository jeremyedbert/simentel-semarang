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
                        // $query->where('kecamatan_id', $request->kecamatan_id);
                        // $query->where('kelurahan_id', $request->kelurahan_id); 
                    ->whereNotNull('acc_date')
                    ->filter(request(['kecamatan_id','kelurahan_id']))
                    ->get();
        
        $kecamatan = DB::table('kecamatans')->pluck("name", "id");
        $kelurahan = DB::table('kelurahans')->pluck("name", "id");
        $tipesite = TipeSite::all()->pluck('name', 'id');
        // $zones = Zone::all();
        $zones = Zone::filter(request(['kecamatan_id']))->get();
  
        return view('user.peta-menara', compact('towerMakro', 'kecamatan', 'kelurahan', 'tipesite', 'zones'),['active' => 'peta']);
      
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
        return view('user.detail-menara', [
          'data' => $tower
        ]);
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