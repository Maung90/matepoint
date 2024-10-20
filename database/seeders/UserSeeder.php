<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('Admin'), // Hash password
            'notelp' => '082234567890',
            'harga' => 150000.00,
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Profesional',
            'email' => 'profesional@example.com',
            'password' => Hash::make('Profesional'), // Hash password
            'notelp' => '084298765432',
            'harga' => 75000.00,
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Talent',
            'email' => 'talent@example.com',
            'password' => Hash::make('Talent'), // Hash password
            'notelp' => '085298765432',
            'harga' => 75000.00,
            'role_id' => 3,
        ]);

        User::create([
            'name' => 'Customer',
            'email' => 'user@example.com',
            'password' => Hash::make('Customer'), // Hash password
            'notelp' => '083298765432',
            'harga' => 0.00,
            'role_id' => 4,
        ]);
    }
}
