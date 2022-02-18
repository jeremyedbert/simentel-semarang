<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\TipeSite;
use App\Models\User;
use Illuminate\Http\Request;

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
      $towerMakro = Tower::where('tipe_menara_id', '=', 1)->whereNotNull('acc_date')->get();
      $kecamatan = Kecamatan::all()->pluck('name', 'id');
      $kelurahan = Kelurahan::all()->pluck('name', 'id');
      $tipesite = TipeSite::all()->pluck('name', 'id');
      
      return view('user.peta-menara', compact('towerMakro', 'kecamatan', 'kelurahan', 'tipesite'),['active' => 'peta']);
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