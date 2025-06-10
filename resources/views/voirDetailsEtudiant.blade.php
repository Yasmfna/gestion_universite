@extends('layouts.app_user')

@section('content')
  <!-- Contenu principal -->
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <div class="row justify-content-center">
    <div class="col-md-12">

      <!-- Timeline horizontale de suivi -->
      <div class="timeline-horizontal mb-5">
      @foreach($suivis as $ap)

      @php
       
        $statut = $ap->statut ?? 'en_attente';

        $class = match($statut) {
            'approuve' => 'step done',
            'en_attente' => 'step notified',
            default => 'step pending',
        };
    @endphp




      <div class="{{ $class }}">
      <div class="icon"><i class="fas fa-user-edit"></i></div>
      {{ optional($ap->approbationDemandeType->approbation->roleUser->role)->titre ?? 'Non assigné' }}<br>
      <p>

      Statut : <strong>{{ $ap->statut }}</strong>
      </p>
      </div>

    @endforeach
 
      <!-- <div class="step notified">
        <div class="icon"><i class="fas fa-user-tie"></i></div>
        <div class="label">Resp. de Niveau</div>
      </div>
      <div class="step pending">
        <div class="icon"><i class="fas fa-user-shield"></i></div>
        <div class="label">Directeur MIAGE</div>
      </div>
      <div class="step disabled">
        <div class="icon"><i class="fas fa-university"></i></div>
        <div class="label">Directeur UFR</div>
      </div> -->
      </div>

      <!-- Détails de la demande -->
      <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Détail de la Demande</h5>
      </div>
      <div class="card-body">
        <div class="row mb-4">
        <div class="col-md-6">
          <p><strong>Type de demande :</strong> {{ $types->nom }}</p>
          <p><strong>Date de la demande :</strong> {{ $types->created_at->format('F d, Y') }}</p>
        </div>
        <div class="col-md-6">
          <p><strong>Statut actuel :</strong> <span class="badge bg-warning">{{ $types->statut }}</span></p>
          <p><strong>Observation :</strong>
          <p>{{ $types->description }}</p>
          </p>
        </div>
        </div>

        <div class="content-pra">
        <div class="title">
          <h3>Règles à respecter</h3>
        </div>
        <ul class="lists">
          @foreach(json_decode($types->regles) as $regle)
        <li>
        <div class="icon"><i class='bx bx-check'></i></div>
        <p>{{ $regle }}</p>
        </li>
      @endforeach
        </ul>
        </div>

        <div class="content-pra">
        <div class="title">
          <h3>Documents requis</h3>
        </div>
        <ul class="lists">
          @foreach($documents as $doc)
        <li>
        <div class="icon"><i class='bx bx-file'></i></div>
        <p><strong>{{ $doc->documentRequis->nom }}</strong> -
        {{ $doc->documentRequis->description }}
        <br><small>Type : {{ $doc->documentRequis->types }}</small>
        </p>
        </li>
      @endforeach

        </ul>
        <div class="content-pra">
          <div class="title">
          <h3>Approbations nécessaires</h3>
          </div>
          <ul class="lists">
          @foreach($approbations as $ap)
        <li>
        <div class="icon"><i class='bx bx-user-check'></i></div>
        <p>
        <strong>{{ $ap->approbation->titre }}</strong><br>
        {{ $ap->approbation->description }}<br>
        Approuvé par :
        {{ optional($ap->approbation->roleUser->role)->titre ?? 'Non assigné' }}<br>
        Statut : <strong>{{ $ap->approbation->statut }}</strong>
        </p>
        </li>
      @endforeach
          </ul>
        </div>
        <div class="text-end">
          <a href="listeDemandeEnCours.html" class="btn btn-outline-primary">
          <i class="fas fa-arrow-left me-1"></i>Retour à la liste des demandes
          </a>
        </div>
        </div>
      </div>

      </div>
    </div>

  </main>

@endsection