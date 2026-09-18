<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FetchRegistrationEmails extends Command
{
    // Nom de la commande à taper dans le terminal
    protected $signature = 'app:fetch-emails';
    protected $description = 'Récupère les e-mails d\'inscription depuis info@jefieparis2026.com';

    public function handle()
    {
        $this->info("Connexion à la boîte e-mail...");

        try {
            $client = Client::account('default');
            $client->connect();

            // Accéder à la boîte de réception
            $folder = $client->getFolder('INBOX');

            // Récupérer uniquement les e-mails NON LUS
            $messages = $folder->query()->unseen()->get();

            $this->info(count($messages) . " nouveau(x) message(s) trouvé(s).");

            foreach ($messages as $message) {
                $sujet = $message->getSubject()[0] ?? '';
                $expediteur = $message->getFrom()[0]->mail ?? '';
                $corpsText = $message->getTextBody() ?? '';

                // Filtrer par mot-clé dans le sujet
                if (Str::contains(Str::lower($sujet), 'inscription')) {
                    $this->info("Traitement de l'inscription pour : " . $expediteur);

                    // 🏢 INSCRIPTION BASE DE DONNÉES (Exemple d'intégration automatique)
                    // Vérifier si l'utilisateur n'existe pas déjà
                    $userExists = User::where('email', $expediteur)->exists();

                    if (!$userExists) {
                        // Créer le compte utilisateur à partir de l'e-mail reçu
                        User::create([
                            'name' => strstr($expediteur, '@', true), // Nom temporaire basé sur l'email
                            'email' => $expediteur,
                            'password' => Hash::make(Str::random(12)), // Mot de passe aléatoire sécurisé
                            'role' => 'participant'
                        ]);
                        $this->info("Utilisateur créé avec succès !");
                    }

                    // Marquer l'e-mail comme LU pour ne pas le traiter au prochain passage
                    $message->setFlag('Seen');
                }
            }
        } catch (\Exception $e) {
            $this->error("Erreur lors de la récupération : " . $e->getMessage());
        }
    }
}
