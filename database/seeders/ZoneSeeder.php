<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Eloquent::unguard();

        $path = 'database/sql_files/zones.sql';
        $sql = file_get_contents($path);
        DB::unprepared($sql);
        //$this->command->info('Zone table seeded!');
    }
}
