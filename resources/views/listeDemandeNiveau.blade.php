<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tableau de Bord Responsable de Niveau</title>

    <!-- Font Awesome pour les icônes sidebar, navbar -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons pour les cartes statistiques -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="{{asset('dashboard.css')}}" />
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
          Bienvenue sur votre espace cher Responsable de Niveau
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
                            <a class="nav-link text-white active" href="{{route('respo1.dashboard')}}">
                                <i class="fas fa-tachometer-alt"></i> Tableau de bord
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('listeDemandeRespo')}}">
                                <i class="fas fa-file-alt"></i>Liste des Démandes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="profilResponsableNiveau.html">
                                <i class="fas fa-user-circle"></i> Mon profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{route('logout')}}">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            

            <!-- Contenu principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <h2 class="mb-4 text-primary">Les demandes Effectuées</h2>
                <!-- Barre de recherche -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('listeDemande') }}">
                            <input type="text" name="search" class="form-control mb-3" placeholder="Rechercher une demande..." value="{{ $search }}">
                        </form>
                        
                    </div>
                </div>

                <!-- Tableau des demandes -->
                <div class="card shadow-sm">
                    <div class="card-body table-responsive">
                        <table class="table table-hover align-middle" id="demandesTable">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th>Type de demande</th>
                                    <th>Étudiant</th>
                                    <th>Niveau</th>
                                    <th>Date de soumission</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($demandes as $demande)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $demande->demandeType->nom ?? 'Type inconnu' }}</td>
                                        <td>{{ $demande->etudiant->nom ?? '' }} {{ $demande->etudiant->prenom ?? '' }}</td>
                                        <td>{{ $demande->etudiant->niveau ?? 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($demande->date_emission)->format('d M Y') }}</td>
                                        <td>
                                            @php
                                                $couleurs = [
                                                    'Validée' => 'success',
                                                    'En cours' => 'warning',
                                                    'Signée' => 'success',
                                                    'Payée' => 'info',
                                                    'Rejeté Finance' => 'danger',
                                                    'Rejetée' => 'danger',
                                                    'Annulé' => 'danger',
                                                ];
                                                $couleur = $couleurs[$demande->statut] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $couleur }}">{{ $demande->statut }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Aucune demande trouvée.</td>
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