<?php

use App\Models\Building;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BuildingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Building::insert([
            ['name' => 'Este', 'center_id' => 1, 'created_at' => $now],
            ['name' => 'Este', 'center_id' => 2, 'created_at' => $now],
        ]);
    }
}
