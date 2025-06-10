@extends('layouts.app_user')

@section('content')

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <h2 class="mb-4 text-primary">Mes demandes en cours</h2>
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
        <th>Type de demande</th>
        <th>Date de soumission</th>
        <th>Détail</th>
        <th>Statut</th>
        </tr>
      </thead>
      <tbody>

        @foreach($demandes as $demande)
      <tr>
      <td> {{ $demande->demandeType->nom }}</td>
      <td> {{ \Carbon\Carbon::parse($demande->created_at)->format('d/m/Y') }}
      </td>
      <td>
        <a href="{{ route('Suividemandes.show',  $demande->id) }}" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-eye"></i>
        </a>
      </td>
      <td><span class="badge bg-success">{{ ucfirst($demande->statut ?? 'en attente') }}</span></td>
      </tr>

      @endforeach
        <tr>
        <td>Relevé de notes provisoire</td>
        <td>28 mai 2025</td>
        <td>
          <a href="voirDetailsEtudiant.html" class="btn btn-sm btn-outline-primary">
          <i class="fas fa-eye"></i>
          </a>
        </td>
        <td><span class="badge bg-success">Validée</span></td>
        </tr>
    
        <td>Lettre de recommandation</td>
        <td>10 mai 2025</td>
        <td>
          <a href="voirDetailsEtudiant.html" class="btn btn-sm btn-outline-primary">
          <i class="fas fa-eye"></i>
          </a>
        </td>
        <td><span class="badge bg-danger">Rejetée</span></td>

      </tbody>
      </table>
    </div>
    </div>



  </main>
@endsection