<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;

// À ajouter au tout début de la fonction run() :
Role::findOrCreate('super-admin');
Role::findOrCreate('admin-partenaires');
Role::findOrCreate('admin-medias');

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@forum2026.sn',
            'password' => Hash::make('password123'),
        ]);
    }
}
