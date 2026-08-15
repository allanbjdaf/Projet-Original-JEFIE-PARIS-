<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partenaire;
use Illuminate\Support\Str;

class PartenaireSeeder extends Seeder
{
    public function run(): void
    {
        $partenaires = [
            ['nom' => 'PNUD', 'niveau' => 'platinum', 'logo' => 'pnud.png'],
            ['nom' => 'BANQUE MONDIALE', 'niveau' => 'platinum', 'logo' => 'banque-mondiale.png'],
            ['nom' => 'UNESCO', 'niveau' => 'platinum', 'logo' => 'ue.png'],
            ['nom' => 'AFD', 'niveau' => 'gold', 'logo' => 'afd.png'],
            ['nom' => 'BAD', 'niveau' => 'gold', 'logo' => 'bad.png'],
            ['nom' => 'ORANGE', 'niveau' => 'gold', 'logo' => 'ora.png'],
        ];

        foreach ($partenaires as $p) {
            Partenaire::create([
                'nom' => $p['nom'],
                'slug' => Str::slug($p['nom']),
                'niveau' => $p['niveau'],
                'logo' => $p['logo'],
                'a_la_une' => true,
            ]);
        }
    }
}
