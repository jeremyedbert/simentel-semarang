<?php

namespace Database\Seeders;

use App\Models\Applicant;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;

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

        Admin::create([
            'name' => 'Kevin Julio',
            'email' => 'kevin@gmail.com',
            'password' => bcrypt('kevin'),
        ]);
    }
}
