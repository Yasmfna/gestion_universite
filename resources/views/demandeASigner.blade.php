<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Espace Directeur - MIAGE</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('dashboard.css') }}" />
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
              <a class="nav-link text-white active" href="{{ route('dirc1.dashboard') }}">
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
        <!-- Messages de session -->
        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
          <div class="card-header bg-primary text-white">
            Demandes à signer
          </div>
          <div class="card-body">
            <input type="text" class="form-control mb-3" placeholder="Rechercher une demande...">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>Étudiant</th>
                    <th>Type de demande</th>
                    <th>Date</th>
                    <th>Détail</th>
                    <th>Statut</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($demandes as $demande)
                    <tr>
                      <td>{{ $demande->id }}</td>
                      <td>{{ $demande->etudiant->nom ?? 'N/A' }} {{ $demande->etudiant->prenom ?? '' }}</td>
                      <td>{{ $demande->demandeType->nom ?? 'Non défini' }}</td>
                      <td>{{ $demande->created_at->format('d M Y') }}</td>
                      <td>
                        <a href="{{ url('/demande/dirc1/'.$demande->id) }}">
                          <i class="fas fa-eye text-primary" role="button"></i>
                        </a>
                      </td>
                      <td>
                        @if($demande->statut === 'Payée')
                    <span class="badge bg-warning">En cours</span></td>
                    @endif
                      </td>
                      <td>
                        <form action="{{ route('signer.demande.action', $demande->id) }}" method="POST" style="display:inline;">
                          @csrf
                          <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Confirmer la signature ?')">
                            <i class="fas fa-pen-nib"></i>
                          </button>
                        </form>
                        
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="7" class="text-center">Aucune demande à afficher.</td>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
