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
            <!-- Contenu principal -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
        <div class="row g-3 mb-4">
            <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Demandes totales</h5>
                    <p class="fs-4">{{ $stats['total'] }}</p>
                </div>
                <i class="bi bi-collection fs-1"></i>
                </div>
            </div>
            </div>

            <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Validées</h5>
                    <p class="fs-4">{{ $stats['validees'] }}</p>
                </div>
                <i class="bi bi-check2-circle fs-1"></i>
                </div>
            </div>
            </div>

            <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">En cours</h5>
                    <p class="fs-4">{{ $stats['en_cours'] }}</p>
                </div>
                <i class="bi bi-hourglass-split fs-1"></i>
                </div>
            </div>
            </div>

            <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">A Jour</h5>
                    <p class="fs-4">{{ $stats['payees'] }}</p>
                </div>
                <i class="bi bi-wallet2 fs-1"></i>
                </div>
            </div>
            </div>

            <div class="col-md-3 mt-3">
            <div class="card text-white bg-danger">
                <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Rejetées Finance</h5>
                    <p class="fs-4">{{ $stats['rejetees_finance'] }}</p>
                </div>
                <i class="bi bi-x-octagon fs-1"></i>
                </div>
            </div>
            </div>

            <div class="col-md-3">
            <div class="card text-white bg-info">
                <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">Signées</h5>
                    <p class="fs-4">{{ $stats['signees'] }}</p>
                </div>
                <i class="bi bi-wallet2 fs-1"></i>
                </div>
            </div>
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