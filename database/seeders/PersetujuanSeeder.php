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
        $config = ['table' => 'pendaftarans', 'length' => 20, 'prefix' => time()*2, 'field' => 'no_tiket'];
        $no_tiket = IdGenerator::generate($config);

        Persetujuan::create([
            'no_tiket' => $no_tiket,
        ]);
        Persetujuan::create([
            'no_tiket' => time()*3
        ]);
    }
}
