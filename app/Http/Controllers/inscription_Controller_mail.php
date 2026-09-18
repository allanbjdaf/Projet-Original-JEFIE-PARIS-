<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BadgeInscription;
use App\Mail\BadgeCollaborateur;
use App\Models\Inscription;
use Illuminate\Support\Str; // Permet d'utiliser Str::random()

class InscriptionController extends Controller
{
    /**
     * Enregistrer un participant et lui envoyer son badge
     */
    public function storeParticipant(Request $request)
    {
        // 1. Validation et création du participant en BDD
        $inscription = Inscription::create([
            'type_inscription' => 'participant',
            'nom'              => $request->input('nom'),
            'prenom'           => $request->input('prenom'),
            'email'            => $request->input('email'),
            'whatsapp'         => $request->input('whatsapp'),
            'statut'           => 'confirme',
            'numero_badge'     => 'JEFIE-2026-' . strtoupper(Str::random(8)),
            'qr_token'         => Str::random(40),
        ]);

        // 2. ENVOI DE L'EMAIL DE CONFIRMATION AVEC BADGE
        try {
            Mail::to($inscription->email)->send(new BadgeInscription($inscription));
            $inscription->update(['badge_envoye_le' => now()]);
        } catch (\Exception $e) {
            // L'inscription fonctionne même si l'email échoue temporairement
            logger("Erreur envoi email participant : " . $e->getMessage());
        }

        return response()->json(['message' => 'Inscription validée et badge envoyé !', 'data' => $inscription]);
    }

    /**
     * Enregistrer une entreprise, ses collaborateurs et envoyer les badges
     */
    public function storeEntreprise(Request $request)
    {
        // 1. Création du compte entreprise principal
        $inscription = Inscription::create([
            'type_inscription' => 'entreprise',
            'entreprise_nom'   => $request->input('entreprise_nom'),
            'nom'              => $request->input('nom_responsable'),
            'prenom'           => $request->input('prenom_responsable'),
            'email'            => $request->input('email_entreprise'),
            'statut'           => 'confirme',
            'numero_badge'     => 'JEFIE-ENT-2026-' . strtoupper(Str::random(8)),
            'qr_token'         => Str::random(40),
        ]);

        // 2. ENVOI DE L'EMAIL À L'ENTREPRISE
        try {
            Mail::to($inscription->email)->send(new BadgeInscription($inscription));
            $inscription->update(['badge_envoye_le' => now()]);
        } catch (\Exception $e) {
            logger("Erreur envoi email entreprise : " . $e->getMessage());
        }

        // 3. ENVOI DES EMAILS INDIVIDUELS AUX COLLABORATEURS
        if ($inscription->collaborateurs && $inscription->collaborateurs->count() > 0) {
            foreach ($inscription->collaborateurs as $collab) {
                if ($collab->email) {
                    try {
                        Mail::to($collab->email)->send(new BadgeCollaborateur($collab, $inscription));
                        $collab->update(['badge_envoye_le' => now()]);
                    } catch (\Exception $e) {
                        logger("Erreur envoi email collaborateur ID {$collab->id} : " . $e->getMessage());
                    }
                }
            }
        }

        return response()->json(['message' => 'Entreprise et collaborateurs enregistrés !']);
    }
}
