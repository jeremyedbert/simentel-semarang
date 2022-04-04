<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use App\Models\Kelurahan;
use App\Models\Notifikasi;
use App\Models\Kecamatan;
use App\Models\TipeSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardPetaMicroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tower = Tower::where('tipe_menara_id', '=', 2)->whereNotNull('acc_date')->get();
        $kecamatan = Kecamatan::all()->pluck('name', 'id');
        $kelurahan = Kelurahan::all()->pluck('name', 'id');
        $tipesite = TipeSite::all()->pluck('name', 'id');
        // $tower = Tower::all();
        // return response()->json($data);
        // return response()->json(compact('tower', 'kecamatan', 'kelurahan', 'tipesite'));
        return view('admin.peta-mikro', compact('tower', 'kecamatan', 'kelurahan', 'tipesite'), [
            'routes' => 'micro',
            'notif' => Notifikasi::orderBy('mark_as_read', 'asc')->get(),
            'countNotif' => DB::table('notifikasis')
                ->join('pendaftarans', 'notifikasis.pendaftaran_id', '=', 'pendaftarans.id')
                ->whereNull('mark_as_read')->where('pendaftarans.status_id', 1)
                ->count()
        ]);
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
