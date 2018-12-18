<?php

use App\Models\Holiday;
use Illuminate\Database\Seeder;

class HolidayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Holiday::insert([
            ['holiday' => '2018-12-25'],
            ['holiday' => '2019-1-1'],
            ['holiday' => '2019-1-6'],
            ['holiday' => '2019-1-21'],
            ['holiday' => '2019-1-28'],
            ['holiday' => '2019-2-27'],
            ['holiday' => '2019-4-19'],
            ['holiday' => '2019-5-1'],
            ['holiday' => '2019-6-20'],
            ['holiday' => '2019-8-16'],
            ['holiday' => '2019-9-24'],
            ['holiday' => '2019-11-4'],
            ['holiday' => '2019-12-25']
        ]);

    }
}
