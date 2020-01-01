<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    private $roles = [
        ['id' => 1, 'name' => 'Администратор'],
        ['id' => 2, 'name' => 'Пользователь'],
    ];


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->roles as $role) {
            Role::updateOrCreate($role);
        }
    }
}
