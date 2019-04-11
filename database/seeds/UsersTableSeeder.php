<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	'name'			=> 'Suryo Widiyanto',
    		'email'			=> 'suryo@gmail.com',
            'password'      => bcrypt('123'),
    		'photo'   		=> 'public/users_img/123.jpg',
    		'created_at'	=> now(),
    		'updated_at'	=> now(),
        ];

        DB::table('users')->truncate();
        DB::table('users')->insert($data);
    }
}
