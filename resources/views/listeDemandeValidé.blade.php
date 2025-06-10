@extends('layouts.app_user')

@section('content')

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <h2 class="mb-4 text-primary">Mes demandes validées</h2>
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
      <td>           {{ \Carbon\Carbon::parse($demande->created_at)->format('d/m/Y') }}
      </td>
      <td>
        <a href="voirDetailsEtudiant.html" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-eye"></i>
        </a>
      </td>
      <td><span class="badge bg-success">{{ ucfirst($demande->statut ?? 'en attente') }}</span></td>
      </tr>

      @endforeach
        <tr>
        <td>Attestation de fréquentation</td>
        <td>22 mai 2025</td>
        <td>
          <a href="voirDetailsEtudiant.html" class="btn btn-sm btn-outline-primary">
          <i class="fas fa-eye"></i>
          </a>
        </td>
        <td><span class="badge bg-warning">En cours</span></td>
        </tr>
   
      </tbody>
      </table>
    </div>
    </div>



  </main>
@endsection