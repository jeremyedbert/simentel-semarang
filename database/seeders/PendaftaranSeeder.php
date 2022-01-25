<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pendaftaran::create([
            'no_tiket' => time()*2,
            'idUser' => 2,
            'idTower' => 1,
        ]); 
        Pendaftaran::create([
            'no_tiket' => time()*3,
            'idUser' => 1,
            'idTower' => 2,
        ]); 
    }
}
