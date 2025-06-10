<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;

class ResponsableController extends Controller
{
    /**
     * Affiche les demandes (POUR CONSULTATION UNIQUEMENT)
     * - Le responsable ne peut QUE VOIR les demandes
     * - AUCUNE ACTION DE VALIDATION OU TRANSMISSION
     * - On affiche plusieurs statuts pour information
     */
    public function index()
    {
        // Récupère les demandes dans différents états pour consultation
        $demandes = Demande::whereIn('statut', [
            'transmis_saf', 
            'transmis_directeur_miage',
            'transmis_directeur_ufr',
            'approuve'
        ])->latest()->get();  // Tri par date récente
        
        // Affiche la vue avec les demandes (en lecture seule)
        return view('responsable.index', compact('demandes'));
    }

    /**
     * Affiche les détails d'une demande spécifique
     * - UNIQUEMENT POUR CONSULTATION
     * - PAS DE BOUTON D'ACTION
     */
    public function show(Demande $demande)
    {
        // Vérifie que la demande est dans un statut consultable
        if (!in_array($demande->statut, [
            'transmis_saf', 
            'transmis_directeur_miage',
            'transmis_directeur_ufr',
            'approuve'
        ])) {
            abort(403, 'Accès non autorisé à cette demande');
        }

        // Affiche le détail d'une demande (lecture seule)
        return view('responsable.show', compact('demande'));
    }
    
    // PAS DE MÉTHODE DE VALIDATION - LE RESPONSABLE NE TRANSMET RIEN
}
