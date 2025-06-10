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
        $demandesigne=Demande::where('statut', 'Signée')->get();
        return view('directeurMiage', compact('stats','demandesigne'));
    }

    public function show($id)
    {
        $demande = Demande::with(['etudiant', 'demandeType'])->findOrFail($id);
        return view('directeurMiage', compact('demande'));
    }



}


