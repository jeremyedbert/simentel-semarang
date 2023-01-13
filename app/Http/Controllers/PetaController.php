<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\TipeSite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PetaController extends Controller
{
    //
    public function petaMakro(){
      // $tower = Tower::where('tipe_menara_id', '=', 1)->whereNotNull('acc_date')->get();
      $towerMakro = Tower::where('tipe_menara_id', '=', 1)->whereNotNull('acc_date')->get();
      $kecamatan = Kecamatan::all()->pluck('name', 'id');
      $kelurahan = Kelurahan::all()->pluck('name', 'id');
      $tipesite = TipeSite::all()->pluck('name', 'id');
      
      return view('user.peta-menara', compact('towerMakro', 'kecamatan', 'kelurahan', 'tipesite'),['active' => 'peta']);
    }

    public function petaMikro(){
      return view('user.peta-microcell', [
        'dataMikro' => Tower::where('tipe_menara_id', '=', 2)->whereNotNull('acc_date')->get(),
        // 'routes' => 'micro',
        'active' => 'peta'
      ]);
    }
}
