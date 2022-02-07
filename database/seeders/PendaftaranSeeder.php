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
            'id' => 22020223000001,
            'user_id' => 2,
            'tower_id' => 1,
            'status_id' => 1,
        ]);
        Pendaftaran::create([
            // 'id' => time()*3,
            // 'id' => time()*2,
            'id' => 22020223000002,
            'user_id' => 1,
            'tower_id' => 2,
            'status_id' => 1,
        ]);
        Pendaftaran::create([
            // 'id' => time()*3,
            'id' => 22020223000003,
            'user_id' => 2,
            'tower_id' => 3,
            'status_id' => 2,
            'admin_id' => 1,
        ]);
        Pendaftaran::create([
            // 'id' => time()*3,
            'id' => 22020223000004,
            'user_id' => 2,
            'tower_id' => 4,
            'status_id' => 3,
            'admin_id' => 2,
        ]);
        Pendaftaran::create([
            // 'id' => time()*3,
            'id' => 22020708000005,
            'user_id' => 1,
            'tower_id' => 5,
            'status_id' => 2,
            'admin_id' => 1,
        ]);
    }
}
