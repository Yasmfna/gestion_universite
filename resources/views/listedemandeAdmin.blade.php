@extends('layouts.app_admin')

@section('content')
        <div class="card mb-4">
          <div class="card-header bg-primary text-white">
            Liste des demandes
          </div>
          <div class="card-body">
            <form method="GET" action="{{ route('listedemandeAdmin') }}">
              <input type="text" name="search" class="form-control mb-3" placeholder="Rechercher une demande..." value="{{ $search }}">
            </form> 
               <div class="table-responsive">
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
                     @forelse ($demandes as $demande)
                      <tr>
                        <td>{{ $demande->etudiant->prenom }} {{ $demande->etudiant->nom }}</td>
                        <td>{{ $demande->demandeType->nom }}</td>
                        <td>{{ \Carbon\Carbon::parse($demande->date_emission)->format('d M Y') }}</td>
                        <td>
                          <a href="{{ route('demandes.show', $demande->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye"></i>
                          </a>
                        </td>
                        <td>
                          @php
                            $badge = match ($demande->statut) {
                                'Validée' => 'success',
                                'En cours' => 'warning',
                                'Rejetée' => 'danger',
                                default => 'secondary',
                            };
                          @endphp
                          <span class="badge bg-{{ $badge }}">{{ $demande->statut ?? 'Inconnu' }}</span>
                        </td>
                      </tr>
                    @empty
                      <tr><td colspan="5" class="text-center">Aucune demande trouvée.</td></tr>
                    @endforelse
                  </tbody>
                </table>
            </div>
          </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
