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
                'doctor_id' => 1,
                'room_id' => 1
            ],
            [
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
                'day_of_week' => 2,
                'doctor_id' => 1,
                'room_id' => 1
            ],
            [
                'start_time' => '12:00:00',
                'end_time' => '16:00:00',
                'day_of_week' => 3,
                'doctor_id' => 1,
                'room_id' => 2
            ],
            [
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
                'day_of_week' => 1,
                'doctor_id' => 2,
                'room_id' => 3
            ],
            [
                'start_time' => '17:00:00',
                'end_time' => '18:00:00',
                'day_of_week' => 1,
                'doctor_id' => 2,
                'room_id' => 3
            ],
        ]);
    }
}
