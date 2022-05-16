<?php

namespace Database\Seeders;

use App\Models\TipeMenara;
use Illuminate\Database\Seeder;

class TipeMenaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipeMenara::create([
            'name' => 'Makro'
        ]);
        TipeMenara::create([
            'name' => 'Mikro'
        ]);
    }
}
