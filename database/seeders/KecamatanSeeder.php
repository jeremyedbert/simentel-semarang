<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //1
      Kecamatan::create([
        'name' => 'Semarang Tengah'
      ]);
      //2
      Kecamatan::create([
        'name' => 'Semarang Utara'
      ]);
      //3
      Kecamatan::create([
        'name' => 'Semarang Timur'
      ]);
      //4
      Kecamatan::create([
        'name' => 'Gayamsari'
      ]);
      //5
      Kecamatan::create([
        'name' => 'Genuk'
      ]);
      //6
      Kecamatan::create([
        'name' => 'Pedurungan'
      ]);
      //7
      Kecamatan::create([
        'name' => 'Semarang Selatan'
      ]);
      //8
      Kecamatan::create([
        'name' => 'Candisari'
      ]);
      //9
      Kecamatan::create([
        'name' => 'Gajahmungkur'
      ]);
      //10
      Kecamatan::create([
        'name' => 'Tembalang'
      ]);
      //11
      Kecamatan::create([
        'name' => 'Banyumanik'
      ]);
      //12
      Kecamatan::create([
        'name' => 'Gunungpati'
      ]);
      //13
      Kecamatan::create([
        'name' => 'Semarang Barat'
      ]);
      //14
      Kecamatan::create([
        'name' => 'Mijen'
      ]);
      //15
      Kecamatan::create([
        'name' => 'Ngaliyan'
      ]);
      //16
      Kecamatan::create([
        'name' => 'Tugu'
      ]);
      
    }
}
