<?php

namespace Database\Seeders;

use App\Models\Applicant;
use Illuminate\Database\Seeder;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Applicant::truncate();
        Applicant::create([
            'name' => 'Jeremy Edbert Widjaja',
            'phone' => '085162901375',
            'email' => 'jeremy@gmail.com',
            'password' => bcrypt('jeremy'),
        ]);
    }
}
