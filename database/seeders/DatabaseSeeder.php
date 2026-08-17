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
        // On appelle vos seeders pour injecter les vrais comptes administrateurs
        $this->call([
            UserAdminSeeder::class,
        ]);
    }
}
