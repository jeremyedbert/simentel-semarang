<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Jeremy Edbert Widjaja',
            'email' => 'jeremy@gmail.com',
            'phone' => '085162901375',
            'password' => bcrypt('jeremy')
        ]);

        User::create([
          'name' => 'Willy',
          'email' => 'willy@gmail.com',
          'phone' => '082313758289',
          'password' => bcrypt('willy')
        ]);

        Admin::create([
            'name' => 'Kevin Julio',
            'email' => 'kevin@gmail.com',
            'password' => bcrypt('kevin'),
        ]);

        Admin::create([
          'name' => 'Willy Adiguno',
          'email' => 'willyadiguno@gmail.com',
          'password' => bcrypt('willyadiguno'),
        ]);

        $this->call([
          KecamatanSeeder::class,
          KelurahanSeeder::class,
          TipeJalanSeeder::class,
          TipeSiteSeeder::class,
      ]);
    }
}
