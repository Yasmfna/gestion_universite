<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\CustomLoginController;
use App\Http\Controllers\SecretaireFinancierController;
use App\Http\Controllers\SecretairePedagogiqueController;


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


    
    Route::get('/dirc1/dashboard', fn() => view('directeurMiage'))->name('dirc1.dashboard');
    Route::get('/dirc2/dashboard', fn() => view('DirecteurUfr'))->name('dirc2.dashboard');
    Route::get('/respo1/dashboard', fn() => view('responsableNiveau'))->name('respo1.dashboard');


    // Liste des demandes
    Route::get('/admin/demandes', [DemandeController::class, 'index'])->name('listedemandeAdmin');
    Route::get('/admin/demande/{id}', [DemandeController::class, 'show'])->name('demandes.show');


    Route::get('/ajouterUtilisateur', fn() => view('ajouterUtilisateur'))->name('ajouterUtilisateur');
    
    // Liste des utilisateurs
    Route::get('/admin/utilisateurs', [UserController::class, 'index'])->name('listeUtillisateur');
    Route::post('/admin/utilisateurs/ajouter', [UserController::class, 'addUser'])->name('utilisateurs.addUser');
    Route::get('/admin/utilisateurs/{id}/edit', [UserController::class, 'edit'])->name('utilisateurs.edit');
    Route::put('/admin/utilisateurs/{id}', [UserController::class, 'update'])->name('utilisateurs.update');
    Route::delete('/admin/utilisateurs/{id}', [UserController::class, 'destroy'])->name('utilisateurs.destroy');

    Route::get('/voirDetailsEtudiant_Admin', fn() => view('voirDetailsEtudiant_Admin'))->name('voirDetailsEtudiant_Admin');


});


Route::get('/home', fn() => view('index'))->name('home');
  

Route::get('/login_P', [CustomLoginController::class, 'showLoginForm'])->name('login.connecter');
Route::post('/login-submit', [CustomLoginController::class, 'login'])->name('login.submit');

Route::get('/logout', [CustomLoginController::class, 'logout'])->name('logout');
Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');



require __DIR__.'/auth.php';
