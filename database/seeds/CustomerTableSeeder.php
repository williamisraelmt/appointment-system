<?php

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::insert([
            [
                'first_name' => 'Carlos',
                'last_name' => 'Vedolla',
                'gender' => 'm',
                'blood_type' => 'O+',
                'identification_no' => '402-532101-7'
            ],
            [
                'first_name' => 'Marco',
                'last_name' => 'Arten',
                'gender' => 'm',
                'blood_type' => 'A+',
                'identification_no' => '402-531101-7'
            ],
        ]);
    }
}
