<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Réinitialiser le cache de Spatie Permission (Indispensable)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Créer les permissions spécifiques au projet
        Permission::create(['name' => 'gerer tout']);
        Permission::create(['name' => 'gerer partenaires']);
        Permission::create(['name' => 'gerer galeries']);

        // 3. Créer les différents rôles d'administration et leur attribuer les permissions

        // Profil A : Super Admin
        $superAdmin = Role::create(['name' => 'super-admin']);
        $superAdmin->givePermissionTo('gerer tout');

        // Profil B : Admin dédié aux Partenaires
        $partnerAdmin = Role::create(['name' => 'admin-partenaires']);
        $partnerAdmin->givePermissionTo('gerer partenaires');

        // Profil C : Admin dédié à la Galerie Média
        $mediaAdmin = Role::create(['name' => 'admin-medias']);
        $mediaAdmin->givePermissionTo('gerer galeries');

        // (Optionnel) Profil D : L'entrepreneur standard
        Role::create(['name' => 'entrepreneur']);
    }
}
