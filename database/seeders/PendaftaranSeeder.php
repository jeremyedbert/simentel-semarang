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
        $config = ['table' => 'pendaftarans', 'length' => 20, 'prefix' => time()*2, 'field' => 'no_tiket'];
        $no_tiket = IdGenerator::generate($config);

        Pendaftaran::create([
            'no_tiket' => '300300',
            'idUser' => 2,
            'idTower' => 1,
        ]); 
        Pendaftaran::create([
            'no_tiket' => '200200',
            'idUser' => 1,
            'idTower' => 2,
        ]); 
    }
}
