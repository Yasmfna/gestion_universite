<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;

class DemandeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $demandes = Demande::with(['etudiant', 'demandeType'])
            ->when($search, function ($query, $search) {
                $query->whereHas('etudiant', function ($q) use ($search) {
                        $q->where('nom', 'like', "%$search%")
                        ->orWhere('prenom', 'like', "%$search%");
                    })
                    ->orWhereHas('demandeType', function ($q) use ($search) {
                        $q->where('nom', 'like', "%$search%");
                    })
                    ->orWhere('date_emission', 'like', "%$search%");
            })
            ->latest()
            ->get();

        return view('listedemandeAdmin', compact('demandes', 'search'));
    }

    public function show($id)
    {
        $demande = Demande::with(['etudiant', 'demandeType'])->findOrFail($id);
        return view('voirDetailsEtudiant_Admin', compact('demande'));
    }
}
