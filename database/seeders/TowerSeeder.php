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
        Tower::create([ // id: 1
            'idMenara' => 'SMG454',
            'pemilik' => 'PT Dayamitra Telekomunikasi',
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
        Tower::create([ // id: 2
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
        Tower::create([ // id: 3
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
        Tower::create([ // id: 4
          'idMenara' => 'SpaceX-123',
          'pemilik' => 'Elon Musk',
          'latitude' => -6.990170,
          'longitude' => 110.782663,
          'kecamatan_id' => 15,
          'kelurahan_id' => 162,
          'tipe_menara_id' => 2,
          'tipe_site_id' => 3,
          'tipe_jalan_id' => 1,
          'luas' => '18 meter persegi',
          'tinggi' => 29,
          'penyewa' => 'Tesla',
          'operator' => 'Tesla'
        ]);
        Tower::create([ // id: 5
            'idMenara' => 'VincentAndDesta',
            'pemilik' => 'PT VINDES',
            'latitude' => -6.950170,
            'longitude' => 110.483663,
            'kecamatan_id' => 15,
            'kelurahan_id' => 162,
            'tipe_menara_id' => 1,
            'tipe_site_id' => 2,
            'tipe_jalan_id' => 1,
            'luas' => '18 meter persegi',
            'tinggi' => 29,
            'penyewa' => 'TransMedia',
            'acc_date' => now()
          ]);
        Tower::create([ // id: 6
            'idMenara' => 'Indomie 01',
            'pemilik' => 'PT INDOMIE MICIN',
            'latitude' => -6.965,
            'longitude' => 110.4672,
            'kecamatan_id' => 8,
            'kelurahan_id' => 80,
            'tipe_menara_id' => 1,
            'tipe_site_id' => 3,
            'tipe_jalan_id' => 4,
            'luas' => '10 m2',
            'tinggi' => 69,
            'penyewa' => 'Indofood',
            'acc_date' => now()
          ]);
        Tower::create([ // id: 7
            'idMenara' => 'Waskita Karya v2.0',
            'pemilik' => 'PT Waskita Karya',
            'latitude' => -6.9698,
            'longitude' => 110.472398,
            'kecamatan_id' => 14,
            'kelurahan_id' => 153,
            'tipe_menara_id' => 1,
            'tipe_site_id' => 2,
            'tipe_jalan_id' => 1,
            'luas' => 'Cukup luas',
            'tinggi' => 12,
            'acc_date' => now()
          ]);
    }
}
