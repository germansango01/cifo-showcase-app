<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin — bypasses all gates via Gate::before
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@cifo.local',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $superAdmin->assignRole('Super Admin');

        // Crear usuario como Administrador
        $adminUser = User::factory()->create([
            'name' => "Administrador",
            'email' => "admin@cifo.com",
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
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
