<?php

namespace Database\Seeders;

use App\Models\Notifikasi;
use Illuminate\Database\Seeder;

class NotifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Notifikasi::create([
            'pendaftaran_id' => 22020223000001,
        ]);
        Notifikasi::create([
            'pendaftaran_id' => 22020223000002,
        ]);
    }
}
