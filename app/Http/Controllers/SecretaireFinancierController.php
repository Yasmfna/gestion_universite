<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;

class SecretaireFinancierController extends Controller
{
    

    public function index()
{
    $demandes = Demande::with(['etudiant', 'demandeType'])
        ->where('statut', 'Validée') // validée par secrétaire pédagogique
        ->where('est_soldee', false) // non encore traitée par la secrétaire financière
        ->get();

    return view('listeDemandeVerifieSecretaire2', compact('demandes'));
}



public function traiter(Request $request)
{
    $demande = Demande::findOrFail($request->id);

    if ($request->action === 'valider') {
        $demande->est_soldee = true;
        $demande->statut = 'Payée'; // Marquer comme payée
        $demande->save();
        return back()->with('success', 'Demande validée avec succès.');
    }

    if ($request->action === 'rejeter') {
        $demande->est_soldee = false; // Marquer comme non soldée
        $demande->statut = 'Rejetée finance';
        $demande->save();
        return back()->with('success', 'Demande rejetée avec succès.');
    }

    return back()->with('error', 'Action non reconnue.');
}



    public function indexValidees()
    {
        $demandes = Demande::with(['etudiant', 'demandeType'])
            ->where('est_soldee', true)
            ->get();

        return view('demandesValideesSecretaire2', compact('demandes'));
    }

    public function indexRejetees()
    {
        $demandes = Demande::with(['etudiant', 'demandeType'])
            ->where('statut', 'Rejetée finance')
            ->get();

        return view('demandesRejeteesSecretaire2', compact('demandes'));
    }

     public function dashboard()
{
   $stats = [
    'total' => Demande::where('statut', 'Payée')
    ->orWhere('statut', 'Rejetée finance')
    ->orWhere('statut', 'Validée')
    ->count(),
    'validees' => Demande::where('est_soldee', true)->count(),
    'en_cours' => Demande::where('statut', 'Validée')->where('est_soldee', false)->count(),
    'rejetees' => Demande::where('statut', 'Rejetée finance')->count(),
];
    return view('secretaire2', compact('stats'));
}

    public function show($id)
    {
        $demande = Demande::with(['etudiant', 'demandeType'])->findOrFail($id);
        return view('voirDetailsSecretaire2', compact('demande'));
    }
}
