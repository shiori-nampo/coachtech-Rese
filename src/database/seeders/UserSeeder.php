<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'name' => "オーナー{$i}",
                'email' => "owner{$i}@example.com",
                'password' => Hash::make('password'),
                'role_id' => 2,
                'email_verified_at' => now(),
            ]);
        }

        User::create([
            'name' => "管理者",
            'email' => "admin@example.com",
            'password' => Hash::make('password'),
            'role_id' => 1,
            'email_verified_at' => now(),
        ]);

        for ($i = 1; $i <= 3; $i++) {
            User::create([
                'name' => "user{$i}",
                'email' => "user{$i}@example.com",
                'password' => Hash::make('password'),
                'role_id' => 3,
                'email_verified_at' => now(),
            ]);
        }

    }
}
