<?php

namespace App\Exports;

use App\Http\Controllers\ExcelController;
use App\Models\Tower;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TowerExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function __construct($tipe){
        $this->daftar_tower = $tipe;
    }
    
    public function query()
    {
        if($this->daftar_tower == 0){
            return Tower::query()->where('tipe_menara_id', 1)
                ->orWhere('tipe_menara_id', 2)
                ->whereNotNull('acc_date');
        }
        // return Tower::where('kecamatan_id', 1)->get();
        return Tower::query()
            ->where('tipe_menara_id', $this->daftar_tower)
            ->whereNotNull('acc_date');
    }
}
