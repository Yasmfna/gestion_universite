<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirecteurMiageController extends Controller
{
    /**
     * Affiche les demandes à signer
     * - Demandes avec statut "transmis_directeur_miage"
     */
    public function index()
    {
        $demandes = Demande::where('statut', 'Payée')
                            ->latest()
                            ->get();
        
        return view('directeurMiage', compact('demandes'));
    }


    public function dashboard()
    {
        $stats = [
        'total' => Demande::where('statut', 'Payée')
        ->orWhere('statut', 'Rejetée finance')
        ->orWhere('statut', 'Validée')
        ->orWhere('statut', 'Signée')
        ->count(),
        'validees' => Demande::where('est_soldee', true)->count(),
        'en_cours' => Demande::where('statut', 'Validée')->where('est_soldee', false)->count(),
        'rejetees' => Demande::where('statut', 'Rejetée finance')->count(),
        'signees' => Demande::where('statut', 'Signée')->count(),

    ];
        return view('directeurMiage', compact('stats'));
    }

    public function show($id)
    {
        $demande = Demande::with(['etudiant', 'demandeType'])->findOrFail($id);
        return view('directeurMiage', compact('demande'));
    }


    /**
     * Signe électroniquement la demande
     * - Génère une signature numérique unique
     * - Transmet au Directeur UFR
     */
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
}


