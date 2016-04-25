<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
        	'name' => 'Admin',
        	'slug' => 'admin',
        	'description' => 'Admin role.',
        ]);

        Role::create([
        	'name' => 'Demo',
        	'slug' => 'demo',
        	'description' => 'Demo role.'
        ]);

        DB::table('role_user')->insert([
        	'role_id' => 1,
        	'user_id' => 1,
    	]);

        DB::table('role_user')->insert([
        	'role_id' => 2,
        	'user_id' => 2,
    	]);
    }
}
