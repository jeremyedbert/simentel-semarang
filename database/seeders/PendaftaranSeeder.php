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
            // 'id' => $id,
            'id' => '100',
            'user_id' => 2,
            'tower_id' => 1,
            'status_id' => 1,
        ]); 
        Pendaftaran::create([
            // 'id' => time()*3,
            // 'id' => time()*2,
            'id' => '100100',
            'user_id' => 1,
            'tower_id' => 2,
            'status_id' => 1,
        ]); 
        Pendaftaran::create([
            // 'id' => time()*3,
            'id' => '200200',
            'user_id' => 2,
            'tower_id' => 3,
            'status_id' => 1,
        ]);
    }
}
