<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PetaController extends Controller
{
    //
    public function petaMakro(){
      return view('user.peta-menara', [
        'dataMakro' => Tower::where('tipe_menara_id', '=', 1)->whereNotNull('acc_date')->get(),
        // 'routes' => 'macro',
        'active' => 'peta'
      ]);
    }

    public function petaMikro(){
      return view('user.peta-microcell', [
        'dataMikro' => Tower::where('tipe_menara_id', '=', 2)->whereNotNull('acc_date')->get(),
        // 'routes' => 'micro',
        'active' => 'peta'
      ]);
    }
}
