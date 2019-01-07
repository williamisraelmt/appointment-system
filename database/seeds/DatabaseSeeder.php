<?php

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
         $this->call(
             [
                 CenterTableSeeder::class,
                 BuildingTableSeeder::class,
                 RoomTableSeeder::class,

                 AppointmentTypeTableSeeder::class,
                 UserTableSeeder::class,
                 DoctorSchedulesTableSeeder::class,
                 SpecialityTableSeeder::class,
                 DoctorNonWorkingDayTableSeeder::class,
                 DoctorSpecialityTableSeeder::class,

                 HolidayTableSeeder::class,
             ]
         );
    }
}
