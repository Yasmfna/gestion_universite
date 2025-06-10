<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Espace Directeur - MIAGE</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('dashboard.css')}}" />
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><i class="fas fa-user-tie"></i> Espace Directeur</a>
      <span class="navbar-text mx-auto text-white fw-bold">Bienvenue dans votre espace</span>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav id="sidebar" class="col-md-2 d-none d-md-block bg-primary sidebar pt-5">
        <div class="position-sticky">
          <ul class="nav flex-column text-white">
            <li class="nav-item">
              <a class="nav-link text-white active" href="route('dirc1.dashboard')">
                <i class="fas fa-tachometer-alt"></i> Tableau de bord
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="{{ route('signerDemande') }}">
                <i class="fas fa-file-signature"></i> Demandes à signer
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="profilDirecteurMiage.html">
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
        <div class="row mb-4">
          <div class="col-md-3">
            <div class="card text-white bg-primary">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <h5 class="card-title">Demandes totales</h5>
                  <p class="fs-4">{{ $stats['total'] }}</p>
                </div>
                <i class="fas fa-layer-group fa-2x"></i>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-success">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <h5 class="card-title">Signées</h5>
                  <p class="fs-4">{{ $stats['signees'] }}</p>
                </div>
                <i class="fas fa-file-signature fa-2x"></i>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-warning">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <h5 class="card-title">En attente</h5>
                  <p class="fs-4">{{ $stats['en_cours'] }}</p>
                </div>
                <i class="fas fa-hourglass-half fa-2x"></i>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-white bg-danger">
              <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                  <h5 class="card-title">Rejetées</h5>
                  <p class="fs-4">{{ $stats['rejetees'] }}</p>
                </div>
                <i class="fas fa-times-circle fa-2x"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Tableau des demandes -->
        
        <div class="card">
  <div class="card-header bg-success text-white">
    <i class="fas fa-check-circle"></i> Liste des demandes signées
  </div>
  <div class="card-body">
    @if($demandesigne->isEmpty())
      <p class="text-muted">Aucune demande signée pour le moment.</p>
    @else
    <div class="table-responsive">
      <table class="table table-bordered table-hover align-middle">
        <thead class="table-success">
          <tr>
            <th>ID</th>
            <th>Étudiant</th>
            <th>Type de demande</th>
            <th>Date de signature</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($demandesigne as $demande)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $demande->etudiant->nom }} {{ $demande->etudiant->prenom }}</td>
            <td>{{ $demande->demandeType->nom }}</td>
            <td>{{ \Carbon\Carbon::parse($demande->date_signature_miage)->format('d/m/Y à H:i') }}</td>
            <td>
              <a href="{{ route('telecharger.pdf', $demande->id) }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-download"></i> Télécharger PDF
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @endif
  </div>
</div>




      </main>
    </div>
  </div>

  <script>
    function confirmerSignature() {
      if (confirm("Êtes-vous sûr de vouloir apposer votre signature et cachet sur ce document ?")) {
        alert("Signature apposée avec succès.");
        // Redirection ou appel backend ici
      }
    }

    function confirmerRejet() {
      if (confirm("Êtes-vous sûr de vouloir rejeter cette demande ?")) {
        alert("Demande rejetée.");
        // Redirection ou appel backend ici
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
