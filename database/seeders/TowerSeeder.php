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
            'kecamatan_id' => 5,
            'kelurahan_id' => 51,
            'tipe_menara_id' => 1,
            'tipe_site_id' => 1,
            'tipe_jalan_id' => 2,
            'luas' => '14 x 14 meter',
            'operator' => 'Dayamitra',
            'tinggi' => 27,
        ]);
        Tower::create([
            'idMenara' => 'INDOSAT-360',
            'pemilik' => 'PT. Indo Satelite',
            'latitude' => -6.968925,
            'longitude' => 110.427543,
            'kecamatan_id' => 1,
            'kelurahan_id' => 10,
            'tipe_menara_id' => 1,
            'tipe_site_id' => 2,
            'tipe_jalan_id' => 2,
            'luas' => '18 meter persegi',
            'operator' => 'INDOSAT',
            'tinggi' => 18,
        ]);
        Tower::create([
            'idMenara' => 'BY.U PROVIDER',
            'pemilik' => 'PT TELKOMSEL',
            'latitude' => -6.990189,
            'longitude' => 110.782676,
            'kecamatan_id' => 5,
            'kelurahan_id' => 4,
            'tipe_menara_id' => 2,
            'tipe_site_id' => 3,
            'tipe_jalan_id' => 1,
            'luas' => '18 meter persegi',
            'tinggi' => 29,
            'penyewa' => 'Axis',
            'acc_date' => now()
        ]);
        Tower::create([
          'idMenara' => 'SpaceX-123',
          'pemilik' => 'Elon Musk',
          'latitude' => -6.990170,
          'longitude' => 110.782663,
          'kecamatan_id' => 5,
          'kelurahan_id' => 4,
          'tipe_menara_id' => 2,
          'tipe_site_id' => 3,
          'tipe_jalan_id' => 1,
          'luas' => '18 meter persegi',
          'tinggi' => 29,
          'penyewa' => 'Tesla',
          'operator' => 'Tesla'
        ]);
    }
}
