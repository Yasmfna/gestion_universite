<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\DirecteurMiageController;
use App\Http\Controllers\SecretaireFinancierController;
use App\Http\Controllers\SecretairePedagogiqueController;
use App\Http\Controllers\SignerDemandeController;
use Laravel\SerializableClosure\Contracts\Signer;
use App\Http\Controllers\DirecteurUFRController;
use PhpParser\Node\Scalar\MagicConst\Dir;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/user/dashboard', fn() => view('etudiant'))->name('user.dashboard');

    //Partie SECRETAIRE
    Route::get('/liste-demande-verifie-secretaire1', [SecretairePedagogiqueController::class, 'index'])->name('secre1.dashboard');

    Route::post('/dashboard/pedagogique/action', [SecretairePedagogiqueController::class, 'validerOuRejeter']);
    Route::get('/demandes-validees-secretaire1', [SecretairePedagogiqueController::class, 'indexValidees']);

    Route::get('/demandes-rejetees-secretaire1', [SecretairePedagogiqueController::class, 'indexRejetees']);

    Route::get('/demande/secretaire1/{id}', [SecretairePedagogiqueController::class, 'show']);
    Route::get('/dashboard/secretaire1', [SecretairePedagogiqueController::class, 'dashboard']);




    Route::get('/liste-demande-verifie-secretaire2', [SecretaireFinancierController::class, 'index'])->name('secre2.dashboard');;

    Route::post('/secretaire/Financier/action', [SecretaireFinancierController::class, 'traiter']);
    Route::post('/secretaire2/traiter', [SecretaireFinancierController::class, 'traiter'])->name('secretaire2.traiter');
    Route::get('/demandes-validees-secretaire2', [SecretaireFinancierController::class, 'indexValidees']);

    Route::get('/demandes-rejetees-secretaire2', [SecretaireFinancierController::class, 'indexRejetees']);

    Route::get('/demande/secretaire2/{id}', [SecretaireFinancierController::class, 'show']);

    Route::get('/dashboard/secretaire2', [SecretaireFinancierController::class, 'dashboard']);


    
    Route::get('/dirc2/dashboard', fn() => view('DirecteurUfr'))->name('dirc2.dashboard');
    Route::get('/respo1/dashboard', fn() => view('responsableNiveau'))->name('respo1.dashboard');


    // Routes Directeur Miage
    
        Route::get('/directeurMiage/dashboard', [DirecteurMiageController::class, 'dashboard'])->name('dirc1.dashboard');
        Route::get('/directeurMiage/signer/', [SignerDemandeController::class, 'index'])->name('signerDemande');
        Route::post('directeurMiage/signer/{demande}', [DirecteurMiageController::class, 'signerDemande'])->name('signer');
        Route::get('/demande/dirc1/{id}', [SignerDemandeController::class, 'show']);
        Route::post('/demande/{demande}/signer', [SignerDemandeController::class, 'signerDemande'])->name('signer.demande.action');
        Route::get('/telecharger/{id}', [SignerDemandeController::class, 'telechargerPDF'])->name('telecharger.pdf'); 

    // Route Directeur UFR
    Route::get('/directeurUfr/dashboard', [DirecteurUFRController::class, 'dashboard'])->name('dirc2.dashboard');
    Route::get('/listeDemandeUFR', [DirecteurUFRController::class, 'indexDemande'])->name('listeDemande');

    // Liste des demandes
    Route::get('/admin/demandes', [DemandeController::class, 'index'])->name('listedemandeAdmin');
    Route::get('/admin/demande/{id}', [DemandeController::class, 'show'])->name('demandes.show');
    Route::get('/user/listdemandes', [DemandeController::class, 'showdemand'])->name('listedemandeUser');

    Route::get('/user/demande', [DemandeController::class, 'show'])->name('demandes.show');
    Route::get('/user/demandes', [DemandeController::class, 'showdemandPasser'])->name('passerDemande');
    Route::get('/user/demande/{id}', [DemandeController::class, 'showsuivi'])->name('Suividemandes.show');
    Route::get('/user/profil', [DemandeController::class, 'showProfil'])->name('profil.show');


    Route::get('/ajouterUtilisateur', fn() => view('ajouterUtilisateur'))->name('ajouterUtilisateur');
    
    // Liste des utilisateurs
    Route::get('/admin/utilisateurs', [UserController::class, 'index'])->name('listeUtillisateur');
    Route::post('/admin/utilisateurs/ajouter', [UserController::class, 'addUser'])->name('utilisateurs.addUser');
    Route::get('/admin/utilisateurs/{id}/edit', [UserController::class, 'edit'])->name('utilisateurs.edit');
    Route::put('/admin/utilisateurs/{id}', [UserController::class, 'update'])->name('utilisateurs.update');
    Route::delete('/admin/utilisateurs/{id}', [UserController::class, 'destroy'])->name('utilisateurs.destroy');

    Route::get('/voirDetailsEtudiant_Admin', fn() => view('voirDetailsEtudiant_Admin'))->name('voirDetailsEtudiant_Admin');


});

Route::post('/demandesss/create', [DemandeController::class, 'store'])->name('demande.store');

Route::get('/home', fn() => view('index'))->name('home');
  

Route::get('/login_P', [CustomLoginController::class, 'showLoginForm'])->name('login.connecter');
Route::post('/login-submit', [CustomLoginController::class, 'login'])->name('login.submit');

Route::get('/logout', [CustomLoginController::class, 'logout'])->name('logout');
Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');



require __DIR__.'/auth.php';
