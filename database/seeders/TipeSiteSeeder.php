<?php

namespace Database\Seeders;

use App\Models\TipeSite;
use Illuminate\Database\Seeder;

class TipeSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TipeSite::create([
          'name' => 'Greenfield'
        ]);
        TipeSite::create([
          'name' => 'Monopole'
        ]);
        TipeSite::create([
          'name' => 'Rooftop Pole'
        ]);
        TipeSite::create([
          'name' => 'SST'
        ]);
        TipeSite::create([
          'name' => 'Lainnya'
        ]);
    }
}
