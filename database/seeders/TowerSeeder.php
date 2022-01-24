<?php

namespace Database\Seeders;

use App\Models\Tower;
use Illuminate\Database\Seeder;

class TowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tower::create([
            'idMenara' => 'SMG454',
            'pemilik' => 'PT. Dayamitra Telekomunikasi',
            'latitude' => -7.09275,
            'longitude' => 110.32743,
            'idKec' => 5,
            'idKel' => 51,
            'idTipeMenara' => 1,
            'idSite' => 1,
            'idJalan' => 2,
            'luas' => '14 x 14 meter',
            'operator' => 'Dayamitra',
            'tinggi' => 27,
        ]);
        Tower::create([
            'idMenara' => 'INDOSAT-360',
            'pemilik' => 'PT. Indo Satelite',
            'latitude' => -6.968925,
            'longitude' => 110.427543,
            'idKec' => 1,
            'idKel' => 10,
            'idTipeMenara' => 1,
            'idSite' => 2,
            'idJalan' => 2,
            'luas' => '18 meter persegi',
            'operator' => 'INDOSAT',
            'tinggi' => 18,
        ]);
    }
}
