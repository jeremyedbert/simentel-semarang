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
        $config = ['table' => 'pendaftarans', 'length' => 14, 'prefix' => time() * 2, 'field' => 'id'];
        $no_tiket = IdGenerator::generate($config);

        Persetujuan::create([
            // 'id' => $no_tiket,
            'id' => 200200,
        ]);
        Persetujuan::create([
            // 'id' => time() * 3
            'id' => 300300
        ]);
    }
}
