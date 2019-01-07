<?php

use App\Models\ThirdParty;
use App\Models\User;
use App\Models\ThirdPartyType;
use App\Models\ThirdPartyThirdPartyTypes;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ThirdParty::insert([
            [
                'first_name' => 'Root',
                'last_name' => 'Root',
                'identification_no' => '',
                'status' => 'active',
                'removable' => 0,
            ],
            [
                'first_name' => 'Ramón',
                'last_name' => 'Moronta',
                'identification_no' => '',
                'status' => 'active',
                'removable' => 0,
            ],
        ]);

        User::insert([
            [
                'name' => 'root',
                'email' => 'root@root.com',
                'password' => bcrypt('root'),
                'third_party_id' => 1
            ]
        ]);

        ThirdPartyType::insert([
            ['name' => 'Cliente'],
            ['name' => 'Administrador'],
            ['name' => 'Doctor'],
            ['name' => 'Cajero'],
            ['name' => 'Enfermero'],
        ]);

        ThirdPartyThirdPartyTypes::insert(
            [
                [
                    'third_party_id' => 1,
                    'third_party_type_id' => 2
                ],
                [
                    'third_party_id' => 2,
                    'third_party_type_id' => 2
                ],
                [
                    'third_party_id' => 2,
                    'third_party_type_id' => 3
                ],
            ]);

    }
}
