<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Clay Malven',
        	'email' => 'claycpi@gmail.com',
        	'password' => \Hash::make('K6b18y63'),
        ]);

        User::create([
        	'name' => 'Demo',
        	'email' => 'demo@gmail.com',
        	'password' => \Hash::make('demo'),
        ]);
    }
}
