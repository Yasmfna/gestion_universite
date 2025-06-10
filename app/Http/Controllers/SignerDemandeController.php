<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;

class SignerDemandeController extends Controller
{
    public function index()
    {
        $demandes = Demande::where('statut', 'Payée')->get(); // ou selon votre logique
        return view('demandeASigner', compact('demandes'));
    }


    public function signerDemande(Request $request, Demande $demande)
    {
        // Vérifie que la demande est bien dans le bon état
        if ($demande->statut !== 'Payée') {
            return back()->with('error', 'Action non autorisée sur cette demande');
        }

        // Génère une signature unique basée sur le contenu de la demande
        $signatureContent = $demande->id . $demande->titre . $demande->description . now();
        $signature = hash('sha256', $signatureContent);
        
        // Met à jour la demande
        $demande->update([
            'statut' => 'Signée',
            'signature_miage' => $signature,
            'date_signature_miage' => now(),
            'signataire_miage_id' => Auth::id() // Stocke l'ID du signataire
        ]);

        return view('demandeASigner', compact('demande'));
        return back()->with('success', 'Demande signée et transmise au Directeur UFR!');
    }

    public function telechargerPdf($id)
    {
        $demande = Demande::with(['etudiant', 'typeDemande'])->findOrFail($id);

        // Récupère le nom du type de demande via la relation
        $typeNom = strtolower(trim($demande->typeDemande->nom ?? ''));

        // Choix du template selon le type
        $template = match ($typeNom) {
            'relevé de notes'              => 'demandes.pdf.releve_notes',
            'attestation de réussite'      => 'demandes.pdf.attestation_reussite',
            'attestation de fréquentation' => 'demandes.pdf.attestation_frequentation',
            'attestation d’admission'      => 'demandes.pdf.attestation_admission',
            default                        => abort(404, 'Modèle PDF non défini pour le type de demande.'),
        };

        // Génère le PDF
        $pdf = Pdf::loadView($template, [
            'demande'  => $demande,
            'etudiant' => $demande->etudiant
        ]);

        return $pdf->download("Demande_{$demande->id}.pdf");

    }

}
