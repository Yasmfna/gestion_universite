@vite(['resources/css/dashboard.css'])
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tableau de Bord Secrétaire 1</title>

  <!-- Font Awesome pour les icônes sidebar, navbar -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Bootstrap Icons pour les cartes statistiques -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- CSS personnalisé -->
  <link rel="stylesheet" href="dashboard.css" />
</head>
<body>

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
          Bienvenue sur votre espace secrétaire
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
              <a class="nav-link text-white" href="profilSecretaire1.html">
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
        <h2 class="mb-4 text-primary">Demandes validées</h2>
            <!-- Barre de recherche -->
            <div class="row mb-3">
              <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher une demande...">
              </div>
            </div>

            <!-- Tableau des demandes -->
            <div class="card shadow-sm">
              <div class="card-body table-responsive">
                <table class="table table-hover align-middle" id="demandesTable">
                  <thead class="table-light">
                    <tr>
                      <th>#</th>
                      <th>Étudiant</th>
                      <th>Type de demande</th>
                      <th>Date de soumission</th>
                      <th>Détails</th>
                      <th>Statut</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($demandes as $demande)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $demande->etudiant->nom }} {{ $demande->etudiant->prenom }}</td>
                      <td>{{ $demande->demandeType->nom }}</td>
                      <td>{{ $demande->created_at->format('d/m/Y') }}</td>
                      <td>
                        <a href="{{ url('/demande/secretaire1/'.$demande->id) }}" class="btn btn-sm btn-outline-primary">
                          <i class="fas fa-eye"></i>
                        </a>
                      </td>
                      <td><span class="badge bg-success">{{ $demande->statut}}</span></td>
                      <td>
                      <form method="POST" action="{{ url('/dashboard/pedagogique/action') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $demande->id }}">
                        <button class="btn btn-danger btn-sm" name="action" value="rejeter" title="Rejeter">
                          <i class="bi bi-x"></i>
                        </button>
                      </form>
                    </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="5" class="text-center">Aucune demande validée pour le moment.</td>
                    </tr>
                  @endforelse
                    
                  </tbody>
                </table>
              </div>
            </div>

        <!-- Ici tu peux continuer avec le reste du contenu principal -->

      </main>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
