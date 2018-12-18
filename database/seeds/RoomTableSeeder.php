<?php

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::insert([
            ['name' => '201',
             'building_id' => '1'
            ],
            ['name' => '202',
             'building_id' => '1'
            ],
            ['name' => '201',
             'building_id' => '2'
            ],
            ['name' => '202',
             'building_id' => '2'
            ],
        ]);
    }
}
