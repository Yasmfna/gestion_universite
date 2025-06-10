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
    return view('directeurMiage', compact('stats'));
}


}