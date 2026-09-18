<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Sécurité : On s'assure que les rôles Spatie existent en base de données
        $roleSuperAdmin = Role::findOrCreate('super-admin', 'web');
        $rolePartenaire = Role::findOrCreate('admin-partenaires', 'web');
        $roleMedias     = Role::findOrCreate('admin-medias', 'web');

        // 2. Création du Super Admin principal (avec la colonne 'role' pour votre contrôleur)
        $admin = User::updateOrCreate(
            ['email' => 'admin@forum2026.sn'],
            [
                'name'     => 'Administrateur',
                'password' => Hash::make('password123'),
                'role'     => 'super_admin', // Requis par votre contrôleur personnalisé
            ]
        );
        // On lui assigne officiellement le rôle Spatie
        $admin->assignRole($roleSuperAdmin);

        // 3. Création du compte Super Admin secondaire (si vous souhaitez conserver l'ancien)
        $superAdmin2 = User::updateOrCreate(
            ['email' => 'superadmin@forum2026.com'],
            [
                'name'     => 'Super Administrateur',
                'password' => Hash::make('password123'),
                'role'     => 'super_admin',
            ]
        );
        $superAdmin2->assignRole($roleSuperAdmin);
    }
}
