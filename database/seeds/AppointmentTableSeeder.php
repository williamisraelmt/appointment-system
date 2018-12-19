<?php

use App\Models\Appointment;
use Illuminate\Database\Seeder;

class AppointmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Appointment::insert([
            [
                'scheduled_date' => '2018-12-17',
                'start_time' => '08:00:00',
                'end_time' => '08:45:00',
                'customer_id' => 1,
                'doctor_id' => 1,
                'appointment_type_id' => 1
            ],
            [
                'scheduled_date' => '2018-12-17',
                'start_time' => '10:15:00',
                'end_time' => '12:00:00',
                'customer_id' => 2,
                'doctor_id' => 1,
                'appointment_type_id' => 1
            ],
            [
                'scheduled_date' => '2018-12-17',
                'start_time' => '10:00:00',
                'end_time' => '10:45:00',
                'customer_id' => 2,
                'doctor_id' => 2,
                'appointment_type_id' => 1
            ]
        ]);

    }
}
