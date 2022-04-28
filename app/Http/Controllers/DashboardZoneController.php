<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.zona', [
            'data' => Zone::all(),
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
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        $kecamatan = DB::table('kecamatans')->pluck("name", "id");
        return view('admin.edit-zona', compact('kecamatan'), [
            'data' => $zone,
            'notif' => Notifikasi::orderBy('mark_as_read', 'asc')->get(),
            'countNotif' => DB::table('notifikasis')
                ->join('pendaftarans', 'notifikasis.pendaftaran_id', '=', 'pendaftarans.id')
                ->whereNull('mark_as_read')->where('pendaftarans.status_id', 1)
                ->count()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zone)
    {
        $rules = [
            'name' => 'required',
            'radius' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'kecamatan_id' => 'required'
        ];
        
        $validatedData = $request->validate($rules, [
            'name.required' => 'Kolom nama wajib diisi.',
            'radius.required' => 'Kolom radius wajib diisi.',
            'radius.numeric' => 'Isi radius dengan angka.',
            'latitude.required' => 'Kolom latitude wajib diisi.',
            'longitude.required' => 'Kolom longitude wajib diisi.',
            'latitude.numeric' => 'Isi latitude dengan angka.',
            'longitude.numeric' => 'Isi longitude dengan angka.',
            'kecamatan_id.required' => 'Kolom kecamatan wajib dipilih',
        ]);
        
        // return dd($validatedData);
        Zone::where('id', $zone->id)->update($validatedData);

        return redirect('/admin/zona')->with('success', 'Zona ' . $zone->name . ' berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        //
    }
}
