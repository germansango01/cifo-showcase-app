<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario como Administrador
        $adminUser = User::factory()->create([
            'name' => "Administrador",
            'email' => "admin@cifo.com",
            'password' => Hash::make('admin123'),
        ]);
        $adminUser->assignRole('Admin');

        // Crear usuario como Editor
        $editUser = User::factory()->create([
            'name' => "Editor",
            'email' => "editor@cifo.com",
            'password' => Hash::make('editor123'),
        ]);
        $editUser->assignRole('Editor');

        // Crear usuarios adicionales como Viewers
        User::factory()->count(10)->create()->each(function ($user) {
            $user->assignRole('Viewer');
        });
    }
}
