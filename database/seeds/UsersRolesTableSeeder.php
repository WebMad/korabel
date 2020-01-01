<?php

use App\Role;
use App\User;
use App\UsersRole;
use Illuminate\Database\Seeder;

class UsersRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UsersRole::updateOrCreate([
            'user_id' => User::ADMIN_ID,
            'role_id' => Role::ADMIN,
        ]);
    }
}
