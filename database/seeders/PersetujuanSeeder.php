<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Persetujuan;

class PersetujuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Persetujuan::create([
            'no_tiket' => time()*2,
        ]);
    }
}
