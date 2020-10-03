<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name' => 'mohaimen',
            'email' => 'mohaimen707@gmail.com',
            'password' => Hash::make('12345678'),
        ];

        User::insert($user);
    }
}
