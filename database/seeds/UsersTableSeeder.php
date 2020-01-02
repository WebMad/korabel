<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    private $users;

    public function __construct()
    {
        $this->users = [
            [
                'id' => 1,
                'name' => env('SU_NAME'),
                'surname' => env('SU_SURNAME', ''),
                'patronymic' => env('SU_PATRONYMIC', ''),
                'email' => env('SU_EMAIL'),
                'password' => env('SU_PASSWORD'),
            ]
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->users as $user) {
            User::updateOrCreate(['id' => $user['id']], [
                'surname' => $user['surname'],
                'name' => $user['name'],
                'patronymic' => $user['patronymic'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
