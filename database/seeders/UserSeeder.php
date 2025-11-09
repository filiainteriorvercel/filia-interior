<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create owner user
        User::create([
            'name' => 'Filia Interior',
            'email' => 'filiainterior@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'owner',
        ]);

        // Create customer users
        User::create([
            'name' => 'Customer 1',
            'email' => 'customer1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Customer 2',
            'email' => 'customer2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}
