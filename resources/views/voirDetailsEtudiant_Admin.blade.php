@extends('layouts.app_admin')

@section('content')
        <div class="row justify-content-center">
          <div class="col-md-12">

            @php
    // Fonction pour déterminer l'état de chaque étape selon le statut global
    function getStepStatus($step, $statut)
    {
        $mapping = [
            'En cours' => [
                'Secretaire1' => 'notified',
                'Secretaire2' => 'disabled',
                'Directeur1' => 'disabled',
                'DirecteurUFR' => 'disabled',
            ],
            'Validée' => [
                'Secretaire1' => 'done',
                'Secretaire2' => 'notified',
                'Directeur1' => 'disabled',
                'DirecteurUFR' => 'disabled',
            ],
            'Signée' => [
                'Secretaire1' => 'done',
                'Secretaire2' => 'done',
                'Directeur1' => 'done',
                'DirecteurUFR' => 'done',
            ],
            'Payée' => [
                'Secretaire1' => 'done',
                'Secretaire2' => 'done',
                'Directeur1' => 'notified',
                'DirecteurUFR' => 'disabled',
            ],
            'Rejeté Finance' => [
                'Secretaire1' => 'done',
                'Secretaire2' => 'disabled danger',  // on va ajouter une classe danger pour bien colorer
                'Directeur1' => 'disabled',
                'DirecteurUFR' => 'disabled',
            ],
            'Rejetée' => [
                'Secretaire1' => 'danger',
                'Secretaire2' => 'danger',
                'Directeur1' => 'danger',
                'DirecteurUFR' => 'danger',
            ],
            'Annulé' => [
                'Secretaire1' => 'danger',
                'Secretaire2' => 'danger',
                'Directeur1' => 'danger',
                'DirecteurUFR' => 'danger',
            ],
        ];

        return $mapping[$statut][$step] ?? 'disabled';
    }
@endphp

            <!-- Timeline horizontale de suivi -->
            <div class="timeline-horizontal mb-5">
                <div class="step {{ getStepStatus('Secretaire1', $demande->statut) }}">
                    <div class="icon"><i class="fas fa-user-edit"></i></div>
                    <div class="label">Secrétaire</div>
                </div>
                <div class="step {{ getStepStatus('Secretaire2', $demande->statut) }}">
                    <div class="icon"><i class="fas fa-money-check-alt"></i></div>
                    <div class="label">Sec. Administratif</div>
                </div>
                <div class="step {{ getStepStatus('Directeur1', $demande->statut) }}">
                    <div class="icon"><i class="fas fa-user-shield"></i></div>
                    <div class="label">Directeur MIAGE</div>
                </div>
                <div class="step {{ getStepStatus('DirecteurUFR', $demande->statut) }}">
                    <div class="icon"><i class="fas fa-university"></i></div>
                    <div class="label">Directeur UFR</div>
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
                    <p><strong>Étudiant :</strong> {{ $demande->etudiant->prenom }} {{ $demande->etudiant->nom }}</p>
                    <p><strong>Type de demande :</strong> {{ $demande->demandeType->nom }}</p>
                    <p><strong>Date de la demande :</strong> {{ \Carbon\Carbon::parse($demande->date_emission)->format('d M Y') }}</p>
                  </div>
                  <div class="col-md-6">
                    <p><strong>Statut actuel :</strong>
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
                                  
                    </p>
                    <p><strong>Observation :</strong> {{ $demande->commentaire ?? 'Aucune observation.' }}</p>
                  </div>
                </div>
                <div class="text-end">
                  <a href="{{ route('listedemandeAdmin') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left me-1"></i>Retour à la liste des demandes
                  </a>
                </div>
              </div>
            </div>

          </div>
        </div>

      

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @endsection
