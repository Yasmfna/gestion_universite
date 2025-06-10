@vite(['resources/css/dashboard.css'])
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tableau de Bord - Secrétaire 2</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="dashboard.css" />
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="fas fa-graduation-cap"></i> Suivi MIAGE</a>
    <span class="navbar-text mx-auto text-white fw-bold">
      Bienvenue sur votre espace Secrétaire financiere
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
            <a class="nav-link text-white active" href="/dashboard/secretaire2">
              <i class="fas fa-tachometer-alt"></i> Tableau de bord
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/liste-demande-verifie-secretaire2">
              <i class="fas fa-file-invoice-dollar"></i> Demandes à vérifier (Paiement)
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/demandes-validees-secretaire2">
              <i class="fas fa-check-circle"></i> Demandes validées
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="/demandes-rejetees-secretaire2">
              <i class="fas fa-times-circle"></i> Demandes rejetées
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-white" href="profilSecretaire2.html">
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
      <div class="card">
        <div class="card-header bg-primary text-white">
          Liste des demandes validées (Paiement)
        </div>
        <div class="card-body">
          <input type="text" class="form-control mb-3" placeholder="Rechercher une demande...">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Nom Étudiant</th>
                  <th>Type</th>
                  <th>Date</th>
                  <th>Détails</th>
                  <th>Scolarité</th>
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
                        <a href="{{ url('/demande/secretaire2/'.$demande->id) }}" class="btn btn-sm btn-outline-primary">
                          <i class="fas fa-eye"></i>
                        </a>
                      </td>
                      <td><span class="badge bg-success">{{ $demande->statut}}</span></td>
                      <td>
                      <form method="POST" action="{{ route('secretaire2.traiter') }}">
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
      </div>

    </main>
  </div>
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
