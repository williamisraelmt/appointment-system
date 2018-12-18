<?php

use App\Models\Center;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CenterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $now = Carbon::now()->toDateTimeString();

        Center::insert(
            [
                [
                    'name' => 'Principal',
                    'address' => 'Ave. Juan Pablo Duarte',
                    'phone' => '8098898848',
                    'created_at' => $now
                ],
                [
                    'name' => 'Secundario',
                    'address' => 'Ave. Juan Pablo Duarte',
                    'phone' => '8095815621',
                    'created_at' => $now
                ],
            ]
        );

    }
}
