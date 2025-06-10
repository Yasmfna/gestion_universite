@extends('layouts.app_user')
@section('content')
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
    <h2 class="mb-4 text-primary">Soumettre une demande</h2>
    <div class="card shadow-sm">
    <div class="card-body">
      <form action="{{ route('demande.store') }}" method="POST">
      @csrf
      <!-- Type de demande -->
      <div class="mb-3">
        <label for="typeDemande" class="form-label">Type de demande</label>
        <select class="form-select" id="typeDemande" name="type_demande_id" required>
        <option value="">-- Sélectionner un type --</option>
        @foreach($types as $type)
      <option value="{{ $type->id }}">{{ $type->nom }}</option>
      @endforeach
        </select>
      </div>

      <!-- Justification -->
      <div class="mb-3">
        <label for="motif" class="form-label">Justification / Motif</label>
        <textarea class="form-control" id="motif" rows="4" placeholder="Expliquer brièvement votre besoin..."
        required></textarea>
      </div>

      <!-- Pièce jointe -->
      <div class="mb-3">
        <label for="fichier" class="form-label">Joindre un fichier (facultatif)</label>
        <input class="form-control" type="file" id="fichier">
      </div>

      <!-- Zone où les fichiers vont s'ajouter -->
      <div id="documents-zone" class="mt-4"></div>

      <!-- Bouton envoyer -->
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-paper-plane me-2"></i>Envoyer la demande
      </button>
      </form>
    </div>
    </div>

  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    $('#typeDemande').on('change', function () {
    const typeId = $(this).val();

    if (typeId) {
      $.ajax({
      url: `/documents-par-type/${typeId}`,
      type: 'GET',
      success: function (data) {
        $('#documents-zone').html(''); // vider l'ancienne zone
        data.forEach((doc, index) => {
        $('#documents-zone').append(`
          <div class="mb-3">
          <label class="form-label">${doc.nom} (${doc.type})</label>
          <input class="form-control" type="file" name="documents[${doc.id}]" accept="${doc.type === 'pdf' ? 'application/pdf' : doc.type === 'photo' ? 'image/*' : '*'}" required>
          <small class="form-text text-muted">${doc.description ?? ''}</small>
          </div>
        `);
        });
      },
      error: function () {
        alert("Erreur lors de la récupération des documents.");
      }
      });
    } else {
      $('#documents-zone').html('');
    }
    });
  </script>
@endsection

