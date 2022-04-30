<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardRiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.riwayat', [
            // 'data' => $data::where('status_id', '=', 2)->orWhere('status_id', '=', 3)
            //     ->get(),
            // scopeSearching'
            'data' => Pendaftaran::whereIn('status_id', [2, 3])
                                ->searching()
                                ->orderBy('updated_at','desc')->get(),
            'notif' => Notifikasi::whereNull('mark_as_read')->get(),
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
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pendaftaran $pendaftaran)
    {
        if($pendaftaran->admin_id != NULL){
            return view('admin.detail-riwayat', [
                'data' => $pendaftaran,
                'notif' => Notifikasi::orderBy('mark_as_read', 'asc')->get(),
                'countNotif' => DB::table('notifikasis')
                    ->join('pendaftarans', 'notifikasis.pendaftaran_id', '=', 'pendaftarans.id')
                    ->whereNull('mark_as_read')->where('pendaftarans.status_id', 1)
                    ->count()
            ]);
        } else{
            return view('admin.404', [
                'notif' => Notifikasi::orderBy('mark_as_read', 'asc')->get(),
                'countNotif' => DB::table('notifikasis')
                    ->join('pendaftarans', 'notifikasis.pendaftaran_id', '=', 'pendaftarans.id')
                    ->whereNull('mark_as_read')->where('pendaftarans.status_id', 1)
                    ->count()
            ]);
        }
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
