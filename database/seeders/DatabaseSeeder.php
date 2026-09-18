<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // On appelle les seeders dans l'ordre logique d'exécution
        $this->call([
            RolesAndPermissionsSeeder::class, // 1. On crée d'abord les rôles Spatie
            UserAdminSeeder::class,           // 2. On crée les utilisateurs et on leur lie les rôles
        ]);
    }
}
