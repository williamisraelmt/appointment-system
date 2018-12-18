<?php

use App\Models\DoctorNonWorkingDay;
use Illuminate\Database\Seeder;

class DoctorNonWorkingDayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DoctorNonWorkingDay::insert([
            [
                'doctor_id' => 1,
                'non_working_date' => '2018-12-26'
            ],
            [
                'doctor_id' => 2,
                'non_working_date' => '2018-12-17'
            ]
        ]);
    }
}
