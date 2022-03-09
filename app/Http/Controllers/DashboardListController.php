<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tower;
use App\Models\Zone;

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
        $zones = Zone::all();
        $tipemenara = DB::table('tipe_menaras')->get();
        $kecamatan = DB::table('kecamatans')->pluck("name", "id");
        $tipejalan = DB::table('tipe_jalans')->get();
        $tipesite = DB::table('tipe_sites')->get();
        // return dd($countNotif);
        // return response()->json($pendaftaran);
        return view('admin.edit', compact('tipemenara', 'kecamatan', 'tipejalan', 'tipesite', 'zones', 'pendaftaran'), [
            'data' => $pendaftaran,
            'notif' => Notifikasi::orderBy('mark_as_read', 'asc')->get(),
            'countNotif' => DB::table('notifikasis')
                ->join('pendaftarans', 'notifikasis.pendaftaran_id', '=', 'pendaftarans.id')
                ->whereNull('mark_as_read')->where('pendaftarans.status_id', 1)
                ->count()
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
        // return dd($request->kondisi);
        $rules = [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'kondisi' => 'nullable',
            'penyewa' => 'nullable',
            'noimb' => 'nullable',
            'operator' => 'nullable',
        ];

        $validatedData = $request->validate($rules, [
            'latitude.required' => 'Kolom latitude wajib diisi.',
            'longitude.required' => 'Kolom longitude wajib diisi.',
            'latitude.numeric' => 'Isi latitude dengan angka.',
            'longitude.numeric' => 'Isi longitude dengan angka.'
        ]);

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
        Notifikasi::where('pendaftaran_id', $pendaftaran->id)->update(['mark_as_read' => now()]);
        Tower::where('id', $pendaftaran->tower->id)->update(['acc_date' => now()]);
        return redirect('/admin/pendaftaran')->with('accept', 'Permohonan <b>' . $pendaftaran->id . '</b> diterima. Untuk melihat riwayat, silakan menuju ke <a href="/admin/riwayat">link</a> berikut');
    }
}
