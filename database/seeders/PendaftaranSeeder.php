<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendaftaran;
use Brick\Math\BigInteger;
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
        $config = ['table' => 'pendaftarans', 'length' => 14, 'prefix' => time(), 'field' => 'id'];
        $id = IdGenerator::generate($config);

        Pendaftaran::create([
            // 'id' => $no_tiket,
            'id' => $id,
            'idUser' => 2,
            'idTower' => 1,
        ]); 
        Pendaftaran::create([
            // 'id' => time()*3,
            'id' => time()*2,
            'idUser' => 1,
            'idTower' => 2,
        ]); 
        Pendaftaran::create([
            'id' => time()*3,
            'idUser' => 2,
            'idTower' => 3
        ]);
    }
}
