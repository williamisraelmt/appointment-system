<?php

use App\Models\Speciality;
use Illuminate\Database\Seeder;

class SpecialityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Speciality::insert([
            ['name' => 'Anatomía Patológica' ],
            ['name' => 'Anesteseología' ],
            ['name' => 'Alergología' ],
            ['name' => 'Cardiología' ],
            ['name' => 'Cardiólogo' ],
            ['name' => 'Cirugía Plástica y reparadora' ],
            ['name' => 'Cirugía Torácica' ],
            ['name' => 'Cirugía Vascular' ],
            ['name' => 'Dermatología' ],
            ['name' => 'Diagnóstico por imágenes' ],
            ['name' => 'Endocrinología y nutrición' ],
            ['name' => 'Fisiatría' ],
            ['name' => 'Gastroenterología' ],
            ['name' => 'Genética Médica' ],
            ['name' => 'Geriatría' ],
            ['name' => 'Ginecología' ],
            ['name' => 'Hemoterapia Inmunohermatología' ],
            ['name' => 'Hermatología' ],
            ['name' => 'Hepatología' ],
            ['name' => 'Infectología' ],
            ['name' => 'Medicina general' ],
            ['name' => 'Nefrología' ],
            ['name' => 'Neonatología' ],
            ['name' => 'Neumología' ],
            ['name' => 'Neurología Infantil' ],
            ['name' => 'Neurocirugía' ],
            ['name' => 'Neurología' ],
            ['name' => 'Oncología' ],
            ['name' => 'Ortopedia y Traumatología' ],
            ['name' => 'Oftalmología' ],
            ['name' => 'Otorrinolaringología' ],
            ['name' => 'Patología' ],
            ['name' => 'Pediatría' ],
            ['name' => 'Psiquiatría' ],
            ['name' => 'Proctología' ],
            ['name' => 'Psiquiatría Infanto Juvenil' ],
            ['name' => 'Reumatología' ],
            ['name' => 'Rehabilitación' ],
            ['name' => 'Terapia Intensiva' ],
            ['name' => 'Tocoginecología' ],
            ['name' => 'Traumatología' ],
            ['name' => 'Urología' ]

        ]);
    }
}
