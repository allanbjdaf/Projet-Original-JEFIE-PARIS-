<?php
// app/Http/Controllers/DocumentCandidatController.php

namespace App\Http\Controllers;

use App\Models\DocumentCandidat;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentCandidatController extends Controller
{
    public function index(): View
    {
        $documents = DocumentCandidat::where('user_id', Auth::id())->latest()->get();
        return view('emploi_documents', compact('documents'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'cv'              => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'lettre_motivation' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'diplomes.*'      => ['nullable', 'file', 'mimes:pdf,jpg,png', 'max:5120'],
        ]);

        $uploaded = 0;

        foreach (['cv' => 'CV', 'lettre_motivation' => 'Lettre de motivation'] as $field => $label) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)->store('documents/' . Auth::id(), 'private');
                DocumentCandidat::updateOrCreate(
                    ['user_id' => Auth::id(), 'type' => $field],
                    ['nom_fichier' => $request->file($field)->getClientOriginalName(), 'chemin' => $path, 'taille' => $request->file($field)->getSize()]
                );
                $uploaded++;
            }
        }

        if ($request->hasFile('diplomes')) {
            foreach ($request->file('diplomes') as $file) {
                $path = $file->store('documents/' . Auth::id() . '/diplomes', 'private');
                DocumentCandidat::create([
                    'user_id' => Auth::id(),
                    'type' => 'diplome',
                    'nom_fichier' => $file->getClientOriginalName(),
                    'chemin' => $path,
                    'taille' => $file->getSize(),
                ]);
                $uploaded++;
            }
        }

        return back()->with('success', "✅ {$uploaded} document(s) téléchargé(s) avec succès !");
    }

    public function destroy(int $id): RedirectResponse
    {
        $doc = DocumentCandidat::where('user_id', Auth::id())->findOrFail($id);
        Storage::disk('private')->delete($doc->chemin);
        $doc->delete();
        return back()->with('success', 'Document supprimé.');
    }
}
