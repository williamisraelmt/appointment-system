<?php

use App\Models\AppointmentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AppointmentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $now = Carbon::now()->toDateTimeString();

        AppointmentType::insert([
                ['name' => 'Inicial', 'appointment_time' => '00:45:00', 'created_at' => $now],
                ['name' => 'Entrega de resultados', 'appointment_time' => '00:20:00', 'created_at' => $now],
                ['name' => 'Consulta', 'appointment_time' => '00:45:00', 'created_at' => $now],
                ['name' => 'Cirugía', 'appointment_time' => '04:00:00', 'created_at' => $now]
            ]
        );
    }
}
