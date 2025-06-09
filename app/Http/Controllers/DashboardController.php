<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Demande;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin', [
            'totalUsers'        => User::count(),
            'totalEtudiants'    => Etudiant::count(),
            'totalDemandes'     => Demande::count(),
            'totalValidees'     => Demande::where('statut', 'Validée')->count(),

            // Nouveaux :
            'totalRejetees'     => Demande::where('statut', 'Rejetée')->count(),
            'totalEnCours'      => Demande::where('statut', 'En cours')->count(),
            'totalParRôle'      => User::select('role')->groupBy('role')->selectRaw('count(*) as total, role')->get(),
        ]);
    }
}
