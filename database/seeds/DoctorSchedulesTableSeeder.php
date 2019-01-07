<?php

use App\Models\DoctorSchedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DoctorSchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DoctorSchedule::insert([
            [
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
                'day_of_week' => 1,
                'doctor_id' => 2,
                'max_patients' => 20,
                'room_id' => 1
            ],
            [
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
                'day_of_week' => 2,
                'doctor_id' => 2,
                'max_patients' => 20,
                'room_id' => 1
            ],
        ]);
    }
}
