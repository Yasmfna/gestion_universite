@vite(['resources/css/dashboard.css'])
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tableau de Bord Étudiant</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('dashboard.css')}}" />
</head>
<body>

  <!-- Navbar en haut -->
  <!-- Navbar en haut -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="fas fa-graduation-cap"></i> Suivi MIAGE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarContent">
      <!-- Texte de bienvenue centré -->
      <span class="navbar-text mx-auto text-white fw-bold">
        Bienvenue sur votre espace étudiant
      </span>

      <!-- Cloche de notification à droite -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link position-relative" href="#" title="Notifications">
            <i class="fas fa-bell fa-lg"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              3
              <span class="visually-hidden">notifications non lues</span>
            </span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <!-- Conteneur global -->
  <div class="container-fluid">
    <div class="row">
        <!-- Sidebar gauche -->
        <!-- Sidebar gauche -->
        <nav id="sidebar" class="col-md-2 d-none d-md-block bg-primary sidebar pt-5">
        <div class="position-sticky">
          <ul class="nav flex-column text-white">
            <li class="nav-item">
              <a class="nav-link text-white active" href="/dashboard/secretaire1">
                <i class="fas fa-tachometer-alt"></i> Tableau de bord
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="/liste-demande-verifie-secretaire1">
                <i class="fas fa-file-alt"></i> Démandes à vérifier
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="/demandes-validees-secretaire1">
                <i class="fas fa-check-circle"></i> Démandes validées
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="/demandes-rejetees-secretaire1">
                <i class="fas fa-ban"></i> Démandes rejetées
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="profilSecretaire.html">
                <i class="fas fa-user-circle"></i> Mon profil
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('logout') }}">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
              </a>
            </li>
          </ul>
        </div>
        </nav>
      <!-- Contenu principal -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
        <div class="row justify-content-center">
          <div class="col-md-12">

            <!-- Timeline horizontale de suivi -->
            <div class="timeline-horizontal mb-5 ">
              <div class="step done">
                <div class="icon"><i class="fas fa-user-edit"></i></div>
                <div class="label">Secrétaire</div>
              </div>
              <div class="step done">
                <div class="icon"><i class="fas fa-money-check-alt"></i></div>
                <div class="label">Sec. Administratif</div>
              </div>
              <div class="step notified">
                <div class="icon"><i class="fas fa-user-tie"></i></div>
                <div class="label">Resp. de Niveau</div>
              </div>
              <div class="step pending">
                <div class="icon"><i class="fas fa-user-shield"></i></div>
                <div class="label">Directeur MIAGE</div>
              </div>
              <div class="step disabled">
                <div class="icon"><i class="fas fa-university"></i></div>
                <div class="label">Directeur UFR</div>
              </div>
            </div>

            <!-- Détails de la demande -->
            <div class="card shadow-sm">
              <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Détail de la Demande</h5>
              </div>
              <div class="card-body">
                <div class="row mb-4">
                  <div class="col-md-6">
                    <p><strong>Étudiant :</strong> {{ $demande->etudiant->prenom }} {{ $demande->etudiant->nom }}</p>
                    <p><strong>Date de Naissance :</strong>{{ $demande->etudiant->date_naissance }}</p>
                    <p><strong>Matricule :</strong> {{ $demande->etudiant->matricule }}</p>
                    <p><strong>Email :</strong> {{ $demande->etudiant->email }}</p>
                    <p><strong>Niveau :</strong> {{ $demande->etudiant->niveau }}</p>
                  </div>
                  <div class="col-md-6">
                    <p><strong>Type de demande :</strong>{{ $demande->demandeType->nom }}</p>
                    <p><strong>Date de la demande :</strong>{{ $demande->created_at->format('d/m/Y') }}</p>
                    <p><strong>Statut actuel :</strong>
                        @if(str_contains($demande->statut, 'Validée'))
                          <span class="badge bg-success">Validée</span>
                        @elseif(str_contains($demande->statut, 'En Cours'))
                          <span class="badge bg-warning text-dark">En Cours</span>
                        @elseif(str_contains($demande->statut, 'Annulé'))
                          <span class="badge bg-danger">Rejetée</span>
                        @else
                          <span class="badge bg-info text-dark">{{ $demande->statut }}</span>
                        @endif
                      </p>
                      <p><strong>Commentaire :</strong> {{ $demande->commentaire }}</p>
                  </div>
                  
                </div>
                <div class="text-end mt-4">
                  <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-1"></i>Retour à la liste des demandes
                  </a>
                </div>
              </div>
            </div>

          </div>
        </div>

      </main>





    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
