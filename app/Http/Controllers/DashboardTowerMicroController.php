<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class DashboardTowerMicroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.towers', [
            'data' => Tower::where('tipe_menara_id', '=', 2)->whereNotNull('acc_date')->get(),
            'routes' => 'micro',
            'notif' => Notifikasi::whereNull('mark_as_read')->get(),
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
        return view('admin.tower', [
            'data' => $tower,
            'notif' => Notifikasi::whereNull('mark_as_read')->get(),
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
        Tower::destroy($tower->id);
        return redirect('/admin/menara/makro')->with('success', 'Menara ' . $tower->idMenara . ' dihapus');
    }
}
