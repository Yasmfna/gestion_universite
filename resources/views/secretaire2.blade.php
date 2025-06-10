@vite(['resources/css/dashboard.css'])
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tableau de Bord - Secrétaire 2</title>
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
            <a class="nav-link text-white active" href="secretaire2.html">
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
      <div class="row g-3 mb-4">
        <div class="col-md-3">
          <div class="card text-white bg-primary">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <h5 class="card-title">Total Demandes</h5>
                <p class="fs-4">{{ $stats['total'] }}</p>
              </div>
              <i class="fas fa-folder-open fa-2x"></i>
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
              <i class="fas fa-check fa-2x"></i>
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
              <i class="fas fa-ban fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
  <div class="col-md-6 mx-auto">
    <div class="card shadow rounded-4">
      <div class="card-header bg-white border-0 text-center">
        <h5 class="fw-bold mb-0">Répartition des demandes</h5>
      </div>
      <div class="card-body">
        <canvas id="demandeChart" height="250"></canvas>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('demandeChart');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Validées', 'En cours', 'Rejetées'],
      datasets: [{
        label: 'Répartition',
        data: [{{ $stats['validees'] }}, {{ $stats['en_cours'] }}, {{ $stats['rejetees'] }}],
        backgroundColor: [
          'rgba(25, 135, 84, 0.7)',
          'rgba(255, 193, 7, 0.7)',
          'rgba(220, 53, 69, 0.7)'
        ],
        borderColor: [
          'rgba(25, 135, 84, 1)',
          'rgba(255, 193, 7, 1)',
          'rgba(220, 53, 69, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });
</script>
@endpush


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

 @stack('scripts')
</body>
</html>
