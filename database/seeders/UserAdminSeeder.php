<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Super Admin (Rôle configuré en 'super_admin' pour votre contrôleur)
        User::updateOrCreate(
            ['email' => 'superadmin@forum2026.com'],
            [
                'name'     => 'Super Administrateur',
                'password' => Hash::make('password123'),
                'role'     => 'super_admin', // 👈 Rempli la colonne attendue par le contrôleur
            ]
        );

        // 2. Admin Partenaires
        User::updateOrCreate(
            ['email' => 'partenaires@forum2026.com'],
            [
                'name'     => 'Responsable Partenariats',
                'password' => Hash::make('password123'),
                'role'     => 'partenaire', // 👈 Rempli la colonne attendue par le contrôleur
            ]
        );

        // 3. Admin Médias
        User::updateOrCreate(
            ['email' => 'medias@forum2026.com'],
            [
                'name'     => 'Journaliste Modérateur',
                'password' => Hash::make('password123'),
                'role'     => 'admin', // 👈 Rempli la colonne attendue par le contrôleur
            ]
        );
    }
}
