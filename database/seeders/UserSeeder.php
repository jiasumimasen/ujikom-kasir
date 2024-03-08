<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'zya',
                'email' => 'zya@gmail.com',
                'password' => bcrypt('superzya'),
            ],
            [
                'name' => 'geto',
                'email' => 'geto@gmail.com',
                'password' => bcrypt('supergeto'),
            ],
        ];

        foreach ($user as $key => $user) {
            User::create($user);
        }
    }
}
