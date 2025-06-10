<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use Illuminate\Http\Request;
use App\Notifications\DemandeApprouvee;
use Illuminate\Support\Facades\Log;

class DirecteurUfrController extends Controller
{

    public function index()
    {
        $demandes = Demande::where('statut', 'Payée')
                           ->latest()
                           ->get();
        
        return view('directeurUFR', compact('demandes'));
    }

    public function indexDemande(Request $request)
    {
        $search = $request->input('search');

        $demandes = Demande::with(['etudiant', 'demandeType'])
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->whereHas('etudiant', function ($q) use ($search) {
                            $q->where('nom', 'like', "%$search%")
                            ->orWhere('prenom', 'like', "%$search%");
                        })
                        ->orWhereHas('demandeType', function ($q) use ($search) {
                            $q->where('nom', 'like', "%$search%");
                        })
                        ->orWhere('date_emission', 'like', "%$search%")
                        ->orWhere('statut', 'like', "%$search%");
                });
            })
            ->latest()
            ->get();

        return view('listeDemandeUFR', compact('demandes', 'search'));
    }




    public function dashboard()
{
    $stats = [
        'total' => Demande::count(),
        'signees' => Demande::where('statut', 'Signée')->count(),
        'en_cours' => Demande::where('statut', 'En Cours')->count(),
        'validees' => Demande::where('statut', 'Validée')->count(),
        'payees' => Demande::where('statut', 'Payée')->count(),
        'rejetees_finance' => Demande::where('statut', 'Rejeté Finance')->count(),
    ];

    return view('DirecteurUFR', compact('stats'));
}




}