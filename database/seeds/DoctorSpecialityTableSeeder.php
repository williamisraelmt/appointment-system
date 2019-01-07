<?php

use App\Models\DoctorSpeciality;
use Illuminate\Database\Seeder;

class DoctorSpecialityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DoctorSpeciality::insert([
            ['speciality_id' => 1, 'doctor_id' => 2],
            ['speciality_id' => 1,'doctor_id' => 2],
            ['speciality_id' => 20,'doctor_id' => 2]
        ]);
    }
}
