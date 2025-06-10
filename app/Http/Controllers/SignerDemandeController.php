<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use Barryvdh\DomPDF\Facade\Pdf;

class SignerDemandeController extends Controller
{
    /**
     * Affiche la liste des demandes à signer.
     */
    public function index()
    {
        $demandes = Demande::where('statut', 'Payée')->get(); // filtre selon logique métier
        return view('demandeASigner', compact('demandes'));
    }

    /**
     * Affiche les détails d'une demande.
     */
    public function show($id)
    {
        $demande = Demande::with(['etudiant', 'demandeType'])->findOrFail($id);
        return view('voirDetailsDirecteurMiage', compact('demande'));
    }

    /**
     * Signe une demande spécifique si elle est dans un état correct, puis génère le PDF.
     */
    public function signerDemande(Request $request, Demande $demande)
    {
        if ($demande->statut !== 'Payée') {
            return back()->with('error', 'Action non autorisée sur cette demande.');
        }

        // Génération de la signature
        $signatureContent = $demande->id . $demande->titre . $demande->description . now();
        $signature = hash('sha256', $signatureContent);

        // Mise à jour de la demande
        $demande->update([
            'statut' => 'Signée',
            'signature_miage' => $signature,
            'date_signature_miage' => now(),
        ]);

        // Choix de la vue PDF selon le type de demande
        switch ($demande->demandeType->nom) {
            case 'Attestation de Réussite':
                $view = 'pdfs.attestation_reussite';
                break;
            case 'Attestation de Réussite':
                $view = 'pdfs.attestation_frequentation';
                break;
            case 'Relevé de Notes':
                $view = 'pdfs.releve_notes';
                break;
            case 'Convention de stage':
                $view = 'pdfs.convention';
                break;
            default:
                abort(404, 'Type de document non supporté');
        }

        // Générer le PDF
        $pdf = Pdf::loadView($view, [
            'demande' => $demande,
            'etudiant' => $demande->etudiant,
        ]);

        $fileName = 'demande_' . strtolower(str_replace(' ', '_', $demande->etudiant->nom)) . '_' . strtolower(str_replace(' ', '_', $demande->demandeType->nom)) . '.pdf';

        return $pdf->download($fileName);
    }

    /**
     * Télécharge le PDF correspondant à la demande selon son type.
     */
    public function telechargerPdf($id)
    {
        $demande = Demande::with(['etudiant', 'demandeType'])->findOrFail($id);

        $typeNom = strtolower(trim($demande->demandeType->nom ?? ''));

        $template = match ($typeNom) {
            'relevé de notes'              => 'pdfs.releve_notes',
            'attestation de réussite'      => 'pdfs.attestation_reussite',
            'attestation de fréquentation' => 'pdfs.attestation_frequentation',
            'attestation d’admission'      => 'pdfs.attestation_admission',
            default                        => abort(404, 'Modèle PDF non défini pour le type de demande.'),
        };

        $pdf = Pdf::loadView($template, [
            'demande'  => $demande,
            'etudiant' => $demande->etudiant,
        ]);

        return $pdf->download("demande_{$demande->id}.pdf");
    }
}
