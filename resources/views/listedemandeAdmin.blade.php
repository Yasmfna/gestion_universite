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
                      <th>Étudiant</th>
                      <th>Type de demande</th>
                      <th>Date de soumission</th>
                      <th>Détail</th>
                      <th>Statut</th>
                      <th>Actions</th>
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
                                                $couleurs = [
                                                    'Validée' => 'success',
                                                    'En cours' => 'warning',
                                                    'Signée' => 'success',
                                                    'Payée' => 'info',
                                                    'Rejeté Finance' => 'danger',
                                                    'Rejetée' => 'danger',
                                                    'Annulé' => 'danger',
                                                ];
                                                $couleur = $couleurs[$demande->statut] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $couleur }}">{{ $demande->statut }}</span>
                                        </td>
                                        <td>
                          @if($demande->statut === 'Signée')
                            
                              <a href="{{ route('telecharger.pdf', $demande->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-download"></i> Télécharger PDF
                              </a>
                            
                          @endif
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
