<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;

class RapportController extends Controller
{
    /**
     * Affiche la page des rapports.
     */
    public function index()
    {
        return view('rapports.index');
    }

    /**
     * Télécharge un rapport individuel (PDF).
     */
    public function downloadSingle($id): BinaryFileResponse
    {
        // Simulation d'une base de données pour trouver le fichier associé à l'ID
        $rapports = [
            1 => ['nom' => 'Rapport_Financier_Q4.pdf', 'chemin' => 'rapports/rapport_financier_q4.pdf'],
            2 => ['nom' => 'Performance_Marketing.pdf', 'chemin' => 'rapports/performance_marketing.pdf'],
            3 => ['nom' => 'Audit_Securite_GDPR.pdf', 'chemin' => 'rapports/audit_securite_gdpr.pdf'],
        ];

        if (!array_key_exists($id, $rapports)) {
            abort(404, "Rapport introuvable.");
        }

        $fileInfo = $rapports[$id];
        $path = storage_path('app/private/' . $fileInfo['chemin']);

        // Vérifie si le fichier existe physiquement sur le serveur
        if (!file_exists($path)) {
            abort(404, "Le fichier physique est introuvable sur le serveur.");
        }

        return response()->download($path, $fileInfo['nom']);
    }

    /**
     * Télécharge plusieurs rapports sélectionnés dans une archive ZIP.
     */
    public function downloadZip(Request $request)
    {
        $idsString = $request->query('ids');

        if (!$idsString) {
            return redirect()->back()->with('error', 'Aucun document sélectionné.');
        }

        // Transforme la chaîne "1,2" en tableau [1, 2]
        $ids = explode(',', $idsString);

        $rapportsList = [
            1 => ['nom' => 'Rapport_Financier_Q4.pdf', 'chemin' => 'rapports/rapport_financier_q4.pdf'],
            2 => ['nom' => 'Performance_Marketing.pdf', 'chemin' => 'rapports/performance_marketing.pdf'],
            3 => ['nom' => 'Audit_Securite_GDPR.pdf', 'chemin' => 'rapports/audit_securite_gdpr.pdf'],
        ];

        $zip = new ZipArchive;
        $zipFileName = 'Rapports_Selection_' . time() . '.zip';
        $zipPath = storage_path('app/public/' . $zipFileName);

        // Crée et ouvre l'archive ZIP
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $filesAdded = 0;

            foreach ($ids as $id) {
                if (isset($rapportsList[$id])) {
                    $filePath = storage_path('app/private/' . $rapportsList[$id]['chemin']);

                    if (file_exists($filePath)) {
                        // Ajoute le fichier au ZIP avec son nom d'origine
                        $zip->addFile($filePath, $rapportsList[$id]['nom']);
                        $filesAdded++;
                    }
                }
            }

            $zip->close();

            if ($filesAdded === 0) {
                if (file_exists($zipPath)) {
                    unlink($zipPath);
                }
                abort(404, "Aucun des fichiers sélectionnés n'est disponible sur le serveur.");
            }

            // Télécharge le ZIP puis le supprime du serveur après l'envoi
            return response()->download($zipPath)->deleteFileAfterSend(true);
        }

        abort(500, "Impossible de créer le fichier ZIP.");
    }

    /**
     * Télécharge le programme applicatif exécutable ou compressé.
     */
    public function downloadProgram(): BinaryFileResponse
    {
        $path = storage_path('app/private/programme/application_v2.4.exe');

        if (!file_exists($path)) {
            abort(404, "Le programme d'installation est momentanément indisponible.");
        }

        return response()->download($path, 'Configuration_Application_v2.4.exe');
    }
}
