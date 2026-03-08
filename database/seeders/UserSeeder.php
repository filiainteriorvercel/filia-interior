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
            'phone' => '081200000001',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'owner',
        ]);

        // Create customer users
        User::create([
            'name' => 'Customer 1',
            'email' => 'customer1@gmail.com',
            'phone' => '081200000101',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Customer 2',
            'email' => 'customer2@gmail.com',
            'phone' => '081200000102',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}
