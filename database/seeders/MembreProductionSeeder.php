<?php

namespace Database\Seeders;

use App\Models\Membre;
use Illuminate\Database\Seeder;

class MembreProductionSeeder extends Seeder
{
    public function run(): void
    {
        // Nettoyage préalable pour éviter les doublons en production
        Membre::truncate();

        $membres = [
            [
                'name' => 'Pr. Alpha Oumar Barry',
                'poste' => 'Président Exécutif — JEFIE',
                'category' => 'bureau',
                'bio' => 'Ancien conseiller ministériel et expert international en stratégies d\'innovation technologique et de codéveloppement durable.',
                'photo_url' => 'boaa.jpg',
                'email' => 'a.barry@jefie.org',
                'linkedin_url' => 'https://linkedin.com',
                'ordre' => 1,
            ],
            [
                'name' => 'Dr. Eliane de Montgolfier',
                'poste' => 'Présidente du Comité Scientifique',
                'category' => 'scientifique',
                'bio' => 'Directrice de recherche émérite, spécialiste des dynamiques de transition énergétique et de l\'impact environnemental industriel.',
                'photo_url' => 'baoo.jpeg',
                'email' => 'e.montgolfier@jefie.org',
                'linkedin_url' => 'https://linkedin.com',
                'ordre' => 2,
            ],
            [

                'name' => 'Marc-Antoine Vancamp',
                'poste' => 'Commissaire Général JEFIE Paris 2026',
                'category' => 'organisation',
                'bio' => 'Plus de 20 ans d\'expérience dans l\'organisation et le pilotage opérationnel de sommets internationaux et de salons B2B.',
                'photo_url' => 'bao.jpg',
                'email' => 'ma.vancamp@jefie.org',
                'linkedin_url' => 'https://linkedin.com',
                'ordre' => 3,
            ],
            [
                'name' => 'Fatoumata Diallo-Sy',
                'poste' => 'Directrice des Relations Institutionnelles',
                'category' => 'organisation',
                'bio' => 'Supervise les partenariats stratégiques avec les ministères, les représentations diplomatiques et les agences de développement.',
                'photo_url' => 'bao.jpg',
                'email' => 'f.diallo@jefie.org',
                'linkedin_url' => 'https://linkedin.com',
                'ordre' => 4,
            ],
            [
                'name' => 'Sébastien Legendre',
                'poste' => 'Délégué aux Alliances Privées',
                'category' => 'partenaires',
                'bio' => 'Responsable du consortium des grands groupes industriels et des fonds d\'investissement engagés pour la finance durable.',
                'photo_url' => 'bao.jpg',
                'email' => 's.legendre@partenaires-jefie.org',
                'linkedin_url' => 'https://linkedin.com',
                'ordre' => 5,
            ],
        ];

        foreach ($membres as $membre) {
            Membre::create($membre);
        }
    }
}
