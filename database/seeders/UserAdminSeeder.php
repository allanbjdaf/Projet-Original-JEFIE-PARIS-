<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Super Admin
        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@forum2026.com'],
            [
                'name'     => 'Super Administrateur',
                'password' => Hash::make('password123'),
                'role'     => 'super_admin', // Conservé pour votre contrôleur
            ]
        );
        // On lui assigne le rôle Spatie correspondant (nom exact du RolesAndPermissionsSeeder)
        $superAdmin->assignRole('super-admin'); 

        // 2. Admin Partenaires
        $partnerAdmin = User::updateOrCreate(
            ['email' => 'partenaires@forum2026.com'],
            [
                'name'     => 'Responsable Partenariats',
                'password' => Hash::make('password123'),
                'role'     => 'partenaire', 
            ]
        );
        $partnerAdmin->assignRole('admin-partenaires');

        // 3. Admin Médias
        $mediaAdmin = User::updateOrCreate(
            ['email' => 'medias@forum2026.com'],
            [
                'name'     => 'Journaliste Modérateur',
                'password' => Hash::make('password123'),
                'role'     => 'admin', 
            ]
        );
        $mediaAdmin->assignRole('admin-medias');
    }
}
