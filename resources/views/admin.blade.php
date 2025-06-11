@extends('layouts.app_admin')

@section('content')



    <!-- Contenu principal -->
    <div class="container">
      
      <div class="row g-3 mb-4">
        <div class="col-md-3">
          <div class="card text-white bg-primary">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <h5 class="card-title">Utilisateurs</h5>
                <p class="fs-4">{{ $totalUsers }}</p> <!-- Remplace 120 par ta variable -->
              </div>
              <i class="fas fa-users fa-2x"></i>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card text-white bg-info">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <h5 class="card-title">Étudiants</h5>
                <p class="fs-4">{{ $totalEtudiants }}</p>
              </div>
              <i class="fas fa-user-graduate fa-2x"></i>
            </div>
          </div>
        </div>
        
        <div class="col-md-3">
          <div class="card text-white bg-warning">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <h5 class="card-title">Demandes</h5>
                <p class="fs-4">{{ $totalDemandes }}</p>
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
                <p class="fs-4">{{ $totalValidees }}</p>
              </div>
              <i class="fas fa-check fa-2x"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row g-3 mb-4">
        <div class="col-md-4">
          <div class="card text-white bg-danger">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <h5 class="card-title">Demandes rejetées</h5>
                <p class="fs-4">{{ $totalRejetees }}</p>
              </div>
              <i class="fas fa-times fa-2x"></i>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card text-white bg-secondary">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <h5 class="card-title">Demandes en cours</h5>
                <p class="fs-4">{{ $totalEnCours }}</p>
              </div>
              <i class="fas fa-hourglass-half fa-2x"></i>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card text-white bg-dark">
            <div class="card-body">
              <h5 class="card-title mb-2">Utilisateurs par rôle</h5>
              @foreach($totalParRôle as $item)
                <div>
                  @switch($item->role)
                    @case('secre1')
                      @php $role = 'Secrétaire 1'; @endphp
                      @break

                    @case('secre2')
                      @php $role = 'Secrétaire 2'; @endphp
                      @break

                    @case('dirc1')
                      @php $role = 'Directeur Miage'; @endphp
                      @break

                    @case('dirc2')
                      @php $role = 'Directeur UFR'; @endphp
                      @break

                    @case('respo1')
                      @php $role = 'Responsable de Niveau'; @endphp
                      @break

                    @case('user')
                      @php $role = 'Etudiant'; @endphp
                      @break

                    @default
                      @php $role = ucfirst($item->role); @endphp
                  @endswitch
                  {{ $role }} : <strong>{{ $item->total }}</strong>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

    </div>

    <canvas id="chartDemandes" width="100%" height="40"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
      const ctx = document.getElementById('chartDemandes');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Validées', 'En cours', 'Rejetées'],
          datasets: [{
            label: 'Statut des demandes',
            data: [{{ $totalValidees }}, {{ $totalEnCours }}, {{ $totalRejetees }}],
            backgroundColor: ['#28a745', '#ffc107', '#dc3545']
          }]
        }
      });
    </script>

    

@endsection
