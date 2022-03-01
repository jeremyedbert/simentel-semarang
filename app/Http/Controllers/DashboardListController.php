<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
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
        // return dd(Pendaftaran::all());
        return view('admin.list', [
            'data' => Pendaftaran::where('status_id', '=', 1)
                ->get(),
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
        return view('admin.edit', [
            'data' => $pendaftaran,
            'notif' => Notifikasi::whereNull('mark_as_read')->get(),
        ]);

        // return dd($pendaftaran);
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
        $rules = [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'kondisi' => 'nullable',
            'penyewa' => 'nullable',
            'noimb' => 'nullable',
            'operator' => 'nullable',
        ];

        $validatedData = $request->validate($rules);

        Tower::where('id', $pendaftaran->tower->id)
            ->update($validatedData);

        return redirect('/admin/pendaftaran')->with('success', 'Data ' . $pendaftaran->id . ' berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        // $data = Pendaftaran::where('id', $id)->firstOrFail();
        // $data->delete();
        // Pendaftaran::destroy($pendaftaran->id);
        // Tower::destroy($pendaftaran->tower_id);
        // return redirect('/admin/pendaftaran')->with('success', 'Record has been deleted!');
        // return dd($pendaftaran);
    }

    /* Status 
    2 = disetujui
    3 = ditolak
    */
    public function decline(Pendaftaran $pendaftaran)
    {
        Pendaftaran::where('id', $pendaftaran->id)
            ->update([
                'status_id' => 3,
                'admin_id' => auth()->user()->id
            ]);

        return redirect('/admin/pendaftaran')->with('decline', 'Permohonan <b>' . $pendaftaran->id . '</b> ditolak. Untuk melihat riwayat, silakan menuju ke <a href="/admin/riwayat">link</a> berikut');
    }

    public function accept(Pendaftaran $pendaftaran)
    {
        Pendaftaran::where('id', $pendaftaran->id)
            ->update([
                'status_id' => 2,
                'admin_id' => auth()->user()->id
            ]);

        Tower::where('id', $pendaftaran->tower->id)->update(['acc_date' => now()]);
        return redirect('/admin/pendaftaran')->with('accept', 'Permohonan <b>' . $pendaftaran->id . '</b> diterima. Untuk melihat riwayat, silakan menuju ke <a href="/admin/riwayat">link</a> berikut');
    }
}
