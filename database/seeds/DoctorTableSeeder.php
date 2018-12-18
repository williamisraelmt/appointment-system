<?php

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Doctor::insert([
            [
                'first_name' => 'Lopez',
                'last_name' => 'Canaan',
                'gender' => 'm'
            ],
            [
                'first_name' => 'Fernando',
                'last_name' => 'Suarez',
                'gender' => 'm'
            ],
            [
                'first_name' => 'Fernanda',
                'last_name' => 'Suarez',
                'gender' => 'f'
            ],
        ]);

    }
}
