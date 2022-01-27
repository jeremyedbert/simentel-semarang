<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persetujuan;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PersetujuanSeeder extends Seeder
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

        Persetujuan::create([
            // 'id' => $no_tiket,
            'id' => $id,
        ]);
        Persetujuan::create([
            // 'id' => time() * 3
            'id' => time()*2
        ]);
        Persetujuan::create([
            // 'id' => time() * 3
            'id' => time()*3
        ]);
    }
}
