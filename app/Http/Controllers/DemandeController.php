<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\DemandeType;
use App\Models\Etudiant;
use App\Models\ApprobationDemandeType;
use App\Models\ApprobationSuivi;
use App\Models\DocumentDemande;
use Illuminate\Support\Facades\Auth;
use App\Models\DocumentDemandeType;

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


    public function showdemand()
    {
        
        $userId = Auth::id();
    
    
        
        // Charger les demandes avec le type de demande associé
        $demandes = Demande::with('demandeType')
            ->where('users_id', $userId)
            ->latest()
            ->get();
    
        // Récupère tous les types de demande avec le count par utilisateur connecté
        $demandeCounts = DemandeType::withCount([
            'demandes as user_count' => function ($query) use ($userId) {
                $query->where('users_id', $userId);
            }
        ])->get();
        return view('listeDemandeEnCours', compact('demandeCounts','demandes'));
    }
    public function showProfil()
    {
        
        return view('profilEtudiant');
    }
    public function showdemandPasser()
    {
        $types = DemandeType::all();

        return view('passeDemande',compact('types'));
    }
    public function showsuivi($id)
    {
        $demande = Demande::with(['etudiant', 'demandeType'])->findOrFail($id);
                //  Récupération du type de demande
                $types = DemandeType::findOrFail($demande->demandeType->id);
    
                // Récupération des documents liés
                $documents = DocumentDemandeType::with('documentRequis')
                    ->where('demande_types_id', $types->id)
                    ->get();
            



                    
                // Récupération des approbations liées
                $approbations = ApprobationDemandeType::with('approbation.roleUser.role')
                    ->where('demande_type_id', $types->id)
                    ->orderBy('ordre') // facultatif si tu veux l'ordre d'approbation
                    ->get();
                $suivis = ApprobationSuivi::with('approbationDemandeType.approbation.roleUser.role')
                    ->where('demande_id', $types->id)
                    ->get();
        
        return view('voirDetailsEtudiant', compact('types','documents', 'approbations','suivis'));
    }
    public function sidebarDemandeStats()
    {
        $userId = Auth::id();
    
    
        
        // Charger les demandes avec le type de demande associé
        $demandes = Demande::with('type')
            ->where('users_id', $userId)
            ->latest()
            ->get();
    
        // Récupère tous les types de demande avec le count par utilisateur connecté
        $demandeCounts = DemandeType::withCount([
            'demandes as user_count' => function ($query) use ($userId) {
                $query->where('users_id', $userId);
            }
        ])->get();
    
        return view('home.pages.suivi_demande', compact('demandeCounts','demandes'));
    }





    public function docRequis($id)
    {
         //  Récupération du type de demande
         $types = DemandeType::findOrFail($id);
       
                // Récupération des documents liés
                $documents = DocumentDemandeType::with('documentRequis')
                ->where('demande_types_id', $id)
                ->get();
        
    
        // Renvoyer la vue correspondante
        return view("home.pages.doc_requis",compact('documents')   );
    }



    public function getDocuments($id)
    {


             //  Récupération du type de demande
     $types = DemandeType::findOrFail($id);
   
     // Récupération des documents liés
     $documents = DocumentDemandeType::with('documentRequis')
     ->where('demande_types_id', $id)
     ->get();

     
    
        return response()->json($documents);
    }


    public function store(Request $request)
    {
        $etudiant = Etudiant::where('user_id',Auth::id())->first();
  

        if (!$etudiant) {
            return back()->with('error', 'Aucun profil étudiant associé à ce compte.');
        }
        $demande = Demande::create([
            'users_id' => Auth::id(),
            'demande_type_id' => $request->type_demande_id,
            'etudiant_id' =>$etudiant->id ,
            'date_emission' => now(),
        ]);
        $approbations = ApprobationDemandeType::where('demande_type_id', $request->type_demande_id)->get();

        foreach ($approbations as $approbation) {

            $app =ApprobationSuivi::create([
                'demande_id' => $demande->id,
                'approbation_demande_id' => $approbation->id,
                'user_id' => Auth::id(),
                'statut' => 'en_attente',
                'commentaire' => null,
                'date_approbation' => null,
            ]);
        }


        return redirect()->back()->with('success', 'Votre demande a été enregistrée.');
        
    }


}
