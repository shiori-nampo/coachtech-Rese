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
            ]);
        }
    }
}
