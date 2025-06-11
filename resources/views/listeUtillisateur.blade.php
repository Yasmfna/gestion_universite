@extends('layouts.app_admin')

@section('content')
        <!-- Section Liste des utilisateurs -->
        <div class="card mb-4">
          <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            Liste des utilisateurs
            <a href="{{route('ajouterUtilisateur')}}" class="btn btn-light btn-sm">
              <i class="fas fa-user-plus"></i> Ajouter utilisateur
            </a>
          </div>
          <div class="card-body">
            <form method="GET" action="{{ route('listeUtillisateur') }}">
              <input type="text" name="search" class="form-control mb-3" placeholder="Rechercher un utilisateur..." value="{{ $search }}">
            </form>

            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($utilisateurs as $user)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        @if($user->role == 'user')
                          Etudiant
                        @elseif($user->role == 'dirc1')
                          Directeur Miage
                        @elseif($user->role == 'dirc2')
                          Directeur Ufr
                        @elseif($user->role == 'secre1')
                          Secretaire 1
                        @elseif($user->role == 'secre2')
                          Secretaire finance
                        @else
                          {{ ucfirst($user->role) }}
                        @endif
                      </td>
                      <td class="d-flex gap-2">
                        <a href="{{ route('utilisateurs.edit', $user->id) }}" class="btn btn-sm btn-warning">
                          <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('utilisateurs.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </form>
                      </td>

                    </tr>
                  @empty
                    <tr>
                      <td colspan="4" class="text-center">Aucun utilisateur trouvé.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
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
@endsection
