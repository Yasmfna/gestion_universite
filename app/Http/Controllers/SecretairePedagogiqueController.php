<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;

class SecretairePedagogiqueController extends Controller
{
    public function index()
    {
        $demandes = Demande::with(['etudiant', 'demandeType'])
            ->whereIn('statut', ['En Cours'])
            ->get();

        return view('listeDemandeVerifieSecretaire1', compact('demandes'));
        
    }

    public function indexValidees()
    {
        $demandes = Demande::with(['etudiant', 'demandeType'])
            ->where('statut', 'Validée')
            ->get();

        return view('demandesValideesSecretaire1', compact('demandes'));
    }

    public function indexRejetees()
    {
        $demandes = Demande::with(['etudiant', 'demandeType'])
            ->where('statut', 'Annulé')
            ->get();

        return view('demandesRejeteesSecretaire1', compact('demandes'));
    }


    public function show($id)
    {
        $demande = Demande::with(['etudiant', 'demandeType'])->findOrFail($id);
        return view('voirDetailsSecretaire1', compact('demande'));
    }

    public function dashboard()
{
    $stats = [
        'total' => Demande::where('statut', 'Validée')
        ->orWhere('statut', 'En Cours')
        ->orWhere('statut', 'Annulé')
        ->count(),
        'validees' => Demande::where('statut', 'Validée')->count(),
        'en_cours' => Demande::where('statut', 'En Cours')->count(),
        'rejetees' => Demande::where('statut', 'Annulé')->count(),
    ];

    return view('secretaire1', compact('stats'));
}

    public function validerOuRejeter(Request $request)
    {
        $demande = Demande::findOrFail($request->id);

        if ($request->action === 'valider') {
            $demande->statut = 'Validée'; // ou 'En attente validation financière'
        } elseif ($request->action === 'rejeter') {
            $demande->statut = 'Annulé';
        }

        $demande->save();

        return back()->with('success', 'Action effectuée avec succès.');
    }
}
