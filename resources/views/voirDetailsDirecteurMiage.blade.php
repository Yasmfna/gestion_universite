<!-- resources/views/detailDemande.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Détail de la Demande - Directeur MIAGE</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('dashboard.css') }}" />
  <style>
    /* styles inchangés : timeline, steps, icons... */
    .timeline-horizontal { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
    .step { text-align: center; flex: 1; position: relative; }
    .step::before { content: ''; position: absolute; top: 22px; left: 50%; width: 100%; height: 4px; background-color: #ccc; z-index: -1; transform: translateX(-50%); }
    .step:first-child::before { width: 50%; left: 50%; }
    .step:last-child::before { width: 50%; left: 0; }
    .icon { font-size: 24px; background-color: #ccc; color: white; width: 40px; height: 40px; line-height: 40px; border-radius: 50%; margin: auto; }
    .done .icon { background-color: #28a745; }
    .notified .icon { background-color: #ffc107; }
    .pending .icon { background-color: #0d6efd; }
    .disabled .icon { background-color: #6c757d; }
    .label { margin-top: 8px; font-size: 14px; }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="fas fa-user-tie"></i> Espace Directeur</a>
    <span class="navbar-text mx-auto text-white fw-bold">Bienvenue sur votre espace cher directeur MIAGE</span>
  </div>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebar" class="col-md-2 d-none d-md-block bg-primary sidebar pt-5">
      <div class="position-sticky">
        <ul class="nav flex-column text-white">
          <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('dirc1.dashboard') }}">
              <i class="fas fa-tachometer-alt"></i> Tableau de bord
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white active" href="{{ route('signerDemande') }}">
              <i class="fas fa-file-signature"></i> Demandes à signer
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="#">
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

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
      <div class="row justify-content-center">
        <div class="col-md-12">

          <!-- Timeline -->
          <div class="timeline-horizontal mb-4">
            <div class="step done"><div class="icon"><i class="fas fa-user-edit"></i></div><div class="label">Secrétaire</div></div>
            <div class="step done"><div class="icon"><i class="fas fa-stamp"></i></div><div class="label">Administratif</div></div>
            <div class="step done"><div class="icon"><i class="fas fa-chalkboard-teacher"></i></div><div class="label">Resp. Niveau</div></div>
            <div class="step notified"><div class="icon"><i class="fas fa-user-tie"></i></div><div class="label">Directeur MIAGE</div></div>
            <div class="step disabled"><div class="icon"><i class="fas fa-university"></i></div><div class="label">Directeur UFR</div></div>
          </div>


          <!-- Informations de l'étudiant -->
          <div class="border rounded p-3 mb-4 bg-light">
            <h6 class="mb-3 text-primary"><i class="fas fa-user-graduate me-2"></i>Informations de l'étudiant</h6>
            <div class="row">
              <div class="col-md-6">
                <p><strong>Nom :</strong> {{ $demande->etudiant->nom ?? 'Non renseigné' }}</p>
                <p><strong>Prénom :</strong> {{ $demande->etudiant->prenom ?? 'Non renseigné' }}</p>
                <p><strong>Matricule :</strong> {{ $demande->etudiant->matricule ?? 'Non renseigné' }}</p>
              </div>
              <div class="col-md-6">
                <p><strong>Email :</strong> {{ $demande->etudiant->email ?? 'Non renseigné' }}</p>
                <p><strong>Niveau :</strong> {{ $demande->etudiant->niveau ?? 'Non renseigné' }}</p>
              </div>
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
                  <p><strong>Type de demande :</strong> {{ $demande->demandeType->nom }}</p>
                  <p><strong>Date de la demande :</strong> {{ $demande->created_at->format('d M Y') }}</p>
                </div>
                <div class="col-md-6">
                  <p><strong>Statut actuel :</strong> 
                    @if(str_contains($demande->statut, 'Payée'))
                          <span class="badge bg-warning">En Cours</span>
                        @elseif(str_contains($demande->statut, 'Signée'))
                          <span class="badge bg-success text-dark">Signée</span>
                    @endif
                  </p>
                  <p><strong>Commentaire :</strong> {{ $demande->commentaire}}</p>
                </div>
              </div>

              <!-- Boutons d’action -->
              <div class="d-flex justify-content-between">
                <a href="{{ route('signerDemande') }}" class="btn btn-outline-secondary">
                  <i class="fas fa-arrow-left me-1"></i> Retour à la liste
                </a>

                <div>
                  <form method="POST" action="{{ route('signer.demande.action', $demande->id) }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success me-2" onclick="return confirm('Voulez-vous signer cette demande ?')">
                        <i class="fas fa-pen-nib"></i> Signer
                    </button>
                  </form>


                  <form method="POST" action="" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Voulez-vous vraiment rejeter cette demande ?')">
                      <i class="fas fa-times"></i> Rejeter
                    </button>
                  </form>
                </div>
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
