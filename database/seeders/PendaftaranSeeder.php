<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = ['table' => 'pendaftarans', 'length' => 14, 'prefix' => time()*2, 'field' => 'id'];
        $no_tiket = IdGenerator::generate($config);

        Pendaftaran::create([
            // 'id' => $no_tiket,
            'id' => 200200,
            'idUser' => 2,
            'idTower' => 1,
        ]); 
        Pendaftaran::create([
            // 'id' => time()*3,
            'id' => 300300,
            'idUser' => 1,
            'idTower' => 2,
        ]); 
    }
}
