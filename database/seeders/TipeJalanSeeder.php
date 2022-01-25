<?php

namespace Database\Seeders;

use App\Models\TipeJalan;
use Illuminate\Database\Seeder;

class TipeJalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TipeJalan::create([
          'name' => 'Macadam'
        ]);
        TipeJalan::create([
          'name' => 'Paving Block'
        ]);
        TipeJalan::create([
          'name' => 'Concrete'
        ]);
        TipeJalan::create([
          'name' => 'Asphalt'
        ]);
        TipeJalan::create([
          'name' => 'Lainnya'
        ]);
    }
}
