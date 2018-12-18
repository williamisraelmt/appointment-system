<?php

use App\Models\User;
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

        User::insert([
            [
                'name' => 'root',
                'email' => 'root@root.com',
                'password' => bcrypt('root')
            ]
        ]);

    }
}
