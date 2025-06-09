<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tableau de Bord admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('dashboard.css')}}" />
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="fas fa-graduation-cap"></i> Suivi MIAGE</a>
    <span class="navbar-text mx-auto text-white fw-bold">
      Bienvenue sur votre espace administrateur
    </span>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link position-relative" href="#" title="Notifications">
          <i class="fas fa-bell"></i>
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">2</span>
        </a>
      </li>
    </ul>
  </div>
</nav>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <nav id="sidebar" class="col-md-2 d-none d-md-block bg-primary sidebar pt-5">
      <div class="position-sticky">
        <ul class="nav flex-column text-white">
        <li class="nav-item">
            <a class="nav-link text-white active" href="{{route('admin.dashboard')}}">
            <i class="fas fa-tachometer-alt"></i> Tableau de bord
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{route('listedemandeAdmin')}}">
            <i class="fas fa-list-alt"></i> Liste des demandes
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{route('listeUtillisateur')}}">
            <i class="fas fa-users"></i> Liste des utilisateurs
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white" href="{{route('ajouterUtilisateur')}}">
            <i class="fas fa-user-plus"></i> Ajouter utilisateur
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

    <!-- Main content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
      @yield('content')
    </main>
  </div>

<script>
  function confirmerValidation() {
    if (confirm("Voulez-vous vraiment valider cette demande ?")) {
      alert("Demande validée.");
    }
  }
  function confirmerRejet() {
    if (confirm("Voulez-vous vraiment rejeter cette demande ?")) {
      alert("Demande rejetée.");
    }
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
