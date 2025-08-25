<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@restaurante.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Crear usuario empleado
        User::create([
            'name' => 'Empleado Demo',
            'email' => 'empleado@restaurante.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'empleado',
        ]);

        // Crear usuarios adicionales para pruebas
        User::factory(5)->create([
            'role' => 'empleado',
        ]);
    }
}