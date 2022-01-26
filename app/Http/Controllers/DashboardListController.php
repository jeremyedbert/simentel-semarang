<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tower;

class DashboardListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = DB::table('pendaftarans')
        //     ->join('persetujuans', 'pendaftarans.no_tiket', '=', 'persetujuans.no_tiket', 'inner')
        //     ->join('towers', 'pendaftarans.idTower', '=', 'towers.id')
        //     ->join('tipe_menaras', 'tipe_menaras.id', '=', 'towers.idTipeMenara')
        //     ->join('tipe_sites', 'tipe_sites.id', '=', 'towers.idSite')
        //     ->join('kecamatans', 'kecamatans.id', '=', 'towers.idKec')
        //     ->join('kelurahans', 'kelurahans.id', '=', 'towers.idKel')
        //     ->join('tipe_jalans', 'tipe_jalans.id', '=', 'towers.idJalan')
        //     ->where('persetujuans.idStatus', '=', 1)->get();

        // $data = Tower::all();

        return dd(Pendaftaran::all());
        // return view('admin.list', [
        //     'active' => 'list',
        //     'data' => $data
        // ]);
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
