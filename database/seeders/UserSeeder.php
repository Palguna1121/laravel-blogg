<?php

// database/seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => 'palguna', 'email' => 'palguna@gmail.com', 'password' => Hash::make('password')],
            ['name' => 'rafi', 'email' => 'rafi@gmail.com', 'password' => Hash::make('password')],
            ['name' => 'ika', 'email' => 'ika@gmail.com', 'password' => Hash::make('password')],
        ];

        foreach ($users as $user) {
            User::factory()->create($user);
        }
    }
}
