<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Candidature;
use App\Models\Contact;
use App\Models\DemandePartenariat;
use App\Models\NewsletterAbonne;
use App\Models\RendezVousB2B;
use App\Models\OffreEmploi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{


    // ── Helpers stats communes ─────────────────────────────────
    private function getCounts(): array
    {
        return [
            'inscriptions'      => $this->safeCount(fn() => Inscription::count()),
            'inscriptions_new'  => $this->safeCount(fn() => Inscription::where('created_at', '>=', now()->subDays(1))->count()),
            'candidatures'      => $this->safeCount(fn() => Candidature::count()),
            'candidatures_new'  => $this->safeCount(fn() => Candidature::where('statut', 'en_attente')->count()),
            'contacts'          => $this->safeCount(fn() => Contact::count()),
            'contacts_new'      => $this->safeCount(fn() => Contact::where('lu', false)->count()),
            'partenariats'      => $this->safeCount(fn() => DemandePartenariat::count()),
            'newsletter'        => $this->safeCount(fn() => NewsletterAbonne::where('actif', true)->count()),
            'rdvb2b'            => $this->safeCount(fn() => RendezVousB2B::count()),
            'offres'            => $this->safeCount(fn() => OffreEmploi::where('statut', 'active')->count()),
            'utilisateurs'      => $this->safeCount(fn() => User::count()),
        ];
    }

    private function safeCount(callable $fn): int
    {
        try {
            return $fn();
        } catch (\Exception) {
            return 0;
        }
    }

    // ════════════════════════════════════════════════════════════
    // DASHBOARD
    // ════════════════════════════════════════════════════════════
    public function dashboard(): View
    {
        $counts = $this->getCounts();

        // Activité récente (7 derniers jours)
        $activiteRecente = [];
        try {
            $activiteRecente = collect([
                ...Inscription::select('created_at', DB::raw("'inscription' as type"), 'nom_complet as label')
                    ->where('created_at', '>=', now()->subDays(7))->latest()->take(5)->get()->toArray(),
                ...Candidature::select('created_at', DB::raw("'candidature' as type"), 'nom_complet as label')
                    ->where('created_at', '>=', now()->subDays(7))->latest()->take(5)->get()->toArray(),
                ...Contact::select('created_at', DB::raw("'contact' as type"), 'nom_complet as label')
                    ->where('created_at', '>=', now()->subDays(7))->latest()->take(5)->get()->toArray(),
            ])->sortByDesc('created_at')->take(10)->values();
        } catch (\Exception) {
        }

        // Graphique inscriptions par jour (30 jours)
        $graphInscriptions = [];
        try {
            $graphInscriptions = Inscription::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as total')
            )->where('created_at', '>=', now()->subDays(30))
                ->groupBy('date')->orderBy('date')->get();
        } catch (\Exception) {
        }

        return view('admin.dashboard', compact('counts', 'activiteRecente', 'graphInscriptions'));
    }

    // ════════════════════════════════════════════════════════════
    // INSCRIPTIONS
    // ════════════════════════════════════════════════════════════
    public function inscriptions(Request $request): View
    {
        $query = Inscription::latest();
        if ($request->statut)    $query->where('statut', $request->statut);
        if ($request->type_pass) $query->where('type_pass', $request->type_pass);
        if ($request->pays)      $query->where('pays', $request->pays);
        if ($request->q)         $query->where(function ($q) use ($request) {
            $q->where('nom_complet', 'like', "%{$request->q}%")
                ->orWhere('email', 'like', "%{$request->q}%")
                ->orWhere('numero_badge', 'like', "%{$request->q}%");
        });

        $inscriptions = $query->paginate(20)->withQueryString();
        $counts = $this->getCounts();
        $stats_pass = [];
        try {
            $stats_pass = Inscription::select('type_pass', DB::raw('COUNT(*) as total'))
                ->groupBy('type_pass')->get()->pluck('total', 'type_pass');
        } catch (\Exception) {
        }

        return view('admin.inscriptions', compact('inscriptions', 'counts', 'stats_pass'));
    }

    public function voirInscription(int $id): View
    {
        $inscription = Inscription::findOrFail($id);
        $counts = $this->getCounts();
        return view('admin.inscription-detail', compact('inscription', 'counts'));
    }

    public function changerStatutInscription(Request $request, int $id): RedirectResponse
    {
        $request->validate(['statut' => ['required', 'in:en_attente_paiement,confirme,annule,echec_paiement']]);
        Inscription::findOrFail($id)->update(['statut' => $request->statut]);
        return back()->with('success', '✅ Statut de l\'inscription mis à jour.');
    }

    // ════════════════════════════════════════════════════════════
    // CANDIDATURES
    // ════════════════════════════════════════════════════════════
    public function candidatures(Request $request): View
    {
        $query = Candidature::with('offreEmploi')->latest();
        if ($request->statut)   $query->where('statut', $request->statut);
        if ($request->offre_id) $query->where('offre_id', $request->offre_id);
        if ($request->q)        $query->where(function ($q) use ($request) {
            $q->where('nom_complet', 'like', "%{$request->q}%")
                ->orWhere('email', 'like', "%{$request->q}%")
                ->orWhere('poste_cible', 'like', "%{$request->q}%");
        });
        $candidatures = $query->paginate(20)->withQueryString();
        $offres = OffreEmploi::select('id', 'titre')->get();
        $counts = $this->getCounts();
        return view('admin.candidatures', compact('candidatures', 'offres', 'counts'));
    }

    public function voirCandidature(int $id): View
    {
        $candidature = Candidature::with('offreEmploi')->findOrFail($id);
        $counts = $this->getCounts();
        return view('admin.candidature-detail', compact('candidature', 'counts'));
    }

    public function changerStatutCandidature(Request $request, int $id): RedirectResponse
    {
        $request->validate(['statut' => ['required', 'in:en_attente,en_cours,accepte,refuse']]);
        Candidature::findOrFail($id)->update(['statut' => $request->statut]);
        return back()->with('success', '✅ Statut de la candidature mis à jour.');
    }

    // ════════════════════════════════════════════════════════════
    // CONTACTS & MESSAGES
    // ════════════════════════════════════════════════════════════
    public function contacts(Request $request): View
    {
        $query = Contact::latest();
        if ($request->lu !== null) $query->where('lu', $request->lu === '1');
        if ($request->sujet)       $query->where('sujet', 'like', "%{$request->sujet}%");
        if ($request->q)           $query->where(function ($q) use ($request) {
            $q->where('nom_complet', 'like', "%{$request->q}%")
                ->orWhere('email', 'like', "%{$request->q}%")
                ->orWhere('message', 'like', "%{$request->q}%");
        });
        $contacts = $query->paginate(20)->withQueryString();
        $counts = $this->getCounts();
        return view('admin.contacts', compact('contacts', 'counts'));
    }

    public function voirContact(int $id): View
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['lu' => true]);
        $counts = $this->getCounts();
        return view('admin.contact-detail', compact('contact', 'counts'));
    }

    // ════════════════════════════════════════════════════════════
    // PARTENARIATS
    // ════════════════════════════════════════════════════════════
    public function partenariats(Request $request): View
    {
        try {
            $query = DemandePartenariat::latest();
            if ($request->statut) $query->where('statut', $request->statut);
            if ($request->q)      $query->where('nom_organisme', 'like', "%{$request->q}%");
            $partenariats = $query->paginate(20)->withQueryString();
        } catch (\Exception) {
            $partenariats = collect()->paginate(20);
        }
        $counts = $this->getCounts();
        return view('admin.partenariats', compact('partenariats', 'counts'));
    }

    // ════════════════════════════════════════════════════════════
    // NEWSLETTER
    // ════════════════════════════════════════════════════════════
    public function newsletter(Request $request): View
    {
        try {
            $query = NewsletterAbonne::latest();
            if ($request->actif !== null) $query->where('actif', $request->actif === '1');
            if ($request->q)              $query->where('email', 'like', "%{$request->q}%");
            $abonnes = $query->paginate(30)->withQueryString();
        } catch (\Exception) {
            $abonnes = collect()->paginate(30);
        }
        $counts = $this->getCounts();
        return view('admin.newsletter', compact('abonnes', 'counts'));
    }

    // ════════════════════════════════════════════════════════════
    // RENDEZ-VOUS B2B
    // ════════════════════════════════════════════════════════════
    public function rdvb2b(Request $request): View
    {
        try {
            $query = RendezVousB2B::latest();
            if ($request->statut) $query->where('statut', $request->statut);
            $rdvs = $query->paginate(20)->withQueryString();
        } catch (\Exception) {
            $rdvs = collect()->paginate(20);
        }
        $counts = $this->getCounts();
        return view('admin.rdvb2b', compact('rdvs', 'counts'));
    }

    // ════════════════════════════════════════════════════════════
    // OFFRES D'EMPLOI
    // ════════════════════════════════════════════════════════════
    public function offres(Request $request): View
    {
        $query = OffreEmploi::withCount('candidatures')->latest();
        if ($request->statut) $query->where('statut', $request->statut);
        if ($request->q)      $query->where('titre', 'like', "%{$request->q}%");
        $offres = $query->paginate(20)->withQueryString();
        $counts = $this->getCounts();
        return view('admin.offres', compact('offres', 'counts'));
    }

    public function toggleOffre(int $id): RedirectResponse
    {
        $offre = OffreEmploi::findOrFail($id);
        $offre->update(['statut' => $offre->statut === 'active' ? 'inactive' : 'active']);
        return back()->with('success', 'Statut de l\'offre modifié.');
    }

    // ════════════════════════════════════════════════════════════
    // UTILISATEURS
    // ════════════════════════════════════════════════════════════
    public function utilisateurs(Request $request): View
    {
        $query = User::latest();
        if ($request->role)  $query->where('role', $request->role);
        if ($request->q)     $query->where(function ($q) use ($request) {
            $q->where('name', 'like', "%{$request->q}%")
                ->orWhere('email', 'like', "%{$request->q}%");
        });
        $utilisateurs = $query->paginate(25)->withQueryString();
        $counts = $this->getCounts();
        $stats_roles = [];
        try {
            $stats_roles = User::select('role', DB::raw('COUNT(*) as total'))
                ->groupBy('role')->get()->pluck('total', 'role');
        } catch (\Exception) {
        }
        return view('admin.utilisateurs', compact('utilisateurs', 'counts', 'stats_roles'));
    }

    public function changerRoleUser(Request $request, int $id): RedirectResponse
    {
        $request->validate(['role' => ['required', 'in:candidat,recruteur,entrepreneur,institution,participant_forum,benevole,admin,super_admin']]);
        User::findOrFail($id)->update(['role' => $request->role]);
        return back()->with('success', '✅ Rôle utilisateur mis à jour.');
    }

    // ════════════════════════════════════════════════════════════
    // EXPORT CSV
    // ════════════════════════════════════════════════════════════
    public function export(Request $request): StreamedResponse
    {
        $type = $request->get('type', 'inscriptions');

        $data = match ($type) {
            'inscriptions'  => $this->exportInscriptions(),
            'candidatures'  => $this->exportCandidatures(),
            'contacts'      => $this->exportContacts(),
            'newsletter'    => $this->exportNewsletter(),
            'utilisateurs'  => $this->exportUtilisateurs(),
            default         => $this->exportInscriptions(),
        };

        $filename = $type . '_' . date('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($data) {
            $handle = fopen('php://output', 'w');
            // BOM UTF-8 pour Excel
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));
            foreach ($data as $row) {
                fputcsv($handle, $row, ';');
            }
            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    private function exportInscriptions(): array
    {
        $rows = [['N° Badge', 'Nom', 'Prénom', 'Email', 'Téléphone', 'Organisation', 'Fonction', 'Pays', 'Type participant', 'Type pass', 'Statut', 'Date inscription', 'Montant payé']];
        try {
            Inscription::chunk(500, function ($items) use (&$rows) {
                foreach ($items as $i) {
                    $rows[] = [
                        $i->numero_badge ?? '',
                        $i->nom_complet ?? '',
                        $i->prenom ?? '',
                        $i->email ?? '',
                        $i->telephone ?? '',
                        $i->organisation ?? '',
                        $i->fonction ?? '',
                        $i->pays ?? '',
                        $i->type_participant ?? '',
                        $i->type_pass ?? '',
                        $i->statut ?? '',
                        $i->created_at?->format('d/m/Y H:i') ?? '',
                        $i->montant_paye ?? '0',
                    ];
                }
            });
        } catch (\Exception) {
        }
        return $rows;
    }

    private function exportCandidatures(): array
    {
        $rows = [['Nom', 'Email', 'Téléphone', 'Poste ciblé', 'Offre', 'Entreprise', 'Statut', 'CV joint', 'Date']];
        try {
            Candidature::with('offreEmploi')->chunk(500, function ($items) use (&$rows) {
                foreach ($items as $c) {
                    $rows[] = [
                        $c->nom_complet ?? '',
                        $c->email ?? '',
                        $c->telephone ?? '',
                        $c->poste_cible ?? '',
                        $c->offreEmploi?->titre ?? '',
                        $c->offreEmploi?->entreprise ?? '',
                        $c->statut ?? '',
                        $c->cv_path ? 'Oui' : 'Non',
                        $c->created_at?->format('d/m/Y H:i') ?? '',
                    ];
                }
            });
        } catch (\Exception) {
        }
        return $rows;
    }

    private function exportContacts(): array
    {
        $rows = [['Nom', 'Email', 'Téléphone', 'Sujet', 'Message', 'Lu', 'Date']];
        try {
            Contact::chunk(500, function ($items) use (&$rows) {
                foreach ($items as $c) {
                    $rows[] = [
                        $c->nom_complet ?? '',
                        $c->email ?? '',
                        $c->telephone ?? '',
                        $c->sujet ?? '',
                        $c->message ?? '',
                        $c->lu ? 'Oui' : 'Non',
                        $c->created_at?->format('d/m/Y H:i') ?? '',
                    ];
                }
            });
        } catch (\Exception) {
        }
        return $rows;
    }

    private function exportNewsletter(): array
    {
        $rows = [['Email', 'Actif', 'Source', 'Date abonnement']];
        try {
            NewsletterAbonne::chunk(1000, function ($items) use (&$rows) {
                foreach ($items as $n) {
                    $rows[] = [
                        $n->email ?? '',
                        $n->actif ? 'Oui' : 'Non',
                        $n->source ?? 'site',
                        $n->created_at?->format('d/m/Y H:i') ?? '',
                    ];
                }
            });
        } catch (\Exception) {
        }
        return $rows;
    }

    private function exportUtilisateurs(): array
    {
        $rows = [['Nom', 'Email', 'Rôle', 'Date inscription', 'Email vérifié']];
        try {
            User::chunk(500, function ($items) use (&$rows) {
                foreach ($items as $u) {
                    $rows[] = [
                        $u->name ?? '',
                        $u->email ?? '',
                        $u->role ?? 'candidat',
                        $u->created_at?->format('d/m/Y H:i') ?? '',
                        $u->email_verified_at ? 'Oui' : 'Non',
                    ];
                }
            });
        } catch (\Exception) {
        }
        return $rows;
    }

    // Vue principale export
    public function exportPage(): View
    {
        $counts = $this->getCounts();
        return view('admin.export', compact('counts'));
    }
}
