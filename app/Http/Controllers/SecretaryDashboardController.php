<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\ApprobationDemandeType;
use App\Models\Etudiant;

class SecretaryDashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard');
    }

    public function apiIndex(Request $request)
    {
        $role = $request->query('role', 'secretary_pedagogique');
        $status = $request->query('status', null);

        $roleMap = [
            'secretary_pedagogique' => 1, // Secrétaire pédagogique
            'secretary_financiere' => 3,  // Responsable de la scolarité (financière)
        ];

        $roleId = $roleMap[$role] ?? 1;

        $demands = Demande::with(['demandeType', 'etudiant'])
            ->whereHas('demandeType.approbations', function ($query) use ($roleId) {
                $query->where('role_user_id', $roleId);
            })
            ->when($status, function ($query, $status) {
                $query->where('statut', $status);
            })
            ->get()
            ->map(function ($demande) {
                $approbations = ApprobationDemandeType::where('demande_type_id', $demande->demande_type_id)
                    ->orderBy('ordre')
                    ->get();
                $totalSteps = $approbations->count();
                $currentStep = $approbations->where('approbation_id', $demande->statut == 'Approuvé' ? $totalSteps : 1)->first()->ordre ?? 1;
                $progress = ($totalSteps > 0) ? ($currentStep / $totalSteps) * 100 : 0;

                return [
                    'id' => $demande->id,
                    'etudiant' => $demande->etudiant->nom . ' ' . $demande->etudiant->prenom,
                    'matricule' => $demande->etudiant->matricule,
                    'type' => $demande->demandeType->nom,
                    'statut' => $demande->statut,
                    'date_emission' => $demande->date_emission,
                    'progress' => $progress,
                    'commentaire' => $demande->commentaire,
                    'details' => [
                        'etudiant_email' => $demande->etudiant->email,
                        'etudiant_niveau' => $demande->etudiant->niveau,
                        'demande_description' => $demande->demandeType->description,
                        'demande_regles' => json_decode($demande->demandeType->regles, true),
                    ],
                ];
            });

        return response()->json(['demands' => $demands]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:Approuvé,Rejeté',
            'commentaire' => 'nullable|string|max:255',
        ]);

        $demande = Demande::findOrFail($id);
        $demande->statut = $request->statut;
        $demande->commentaire = $request->commentaire ?? $demande->commentaire;
        $demande->save();

        return response()->json(['message' => 'Statut mis à jour avec succès']);
    }
}