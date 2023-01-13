<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return dd(Tower::find(1)->select(DB::raw('count(*)'))->get());
        return view('user.welcome', [
            'macro' => Tower::where('tipe_menara_id', 1)->where('acc_date', '!=', NULL)->count(),
            'micro' => Tower::where('tipe_menara_id', 2)->where('acc_date', '!=', NULL)->count(),
        ]);
    }
}
