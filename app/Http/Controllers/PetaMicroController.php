<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\TipeSite;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;

class PetaMicroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $towerMikro = Tower::where('tipe_menara_id', 2)
            ->whereNotNull('acc_date')
            ->searching()
            ->filter(request(['kecamatan_id', 'kelurahan_id']))
            ->get();

        $tabelMikro = Tower::where('tipe_menara_id', 2)
            ->whereNotNull('acc_date')
            ->searching()
            ->filter(request(['kecamatan_id', 'kelurahan_id']))
            ->paginate(30)
            ->withQueryString();

        // $towerMikro = Tower::where('tipe_menara_id', '=', 2)->whereNotNull('acc_date')->searching()->get();
        $kecamatan = Kecamatan::all()->pluck('name', 'id');
        $kelurahan = Kelurahan::all()->pluck('name', 'id');
        $tipesite = TipeSite::all()->pluck('name', 'id');

        return view(
            'user.peta-microcell',
            compact(
                'towerMikro',
                'tabelMikro',
                'kecamatan',
                'kelurahan',
                'tipesite'
            ),
            ['active' => 'peta']
        );
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
        $zones = Zone::whereNotNull('id');
        return view('user.detail-menara', [
            'data' => $tower,
            // untuk tidak menampilkan zona
        ], compact('zones'));
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
