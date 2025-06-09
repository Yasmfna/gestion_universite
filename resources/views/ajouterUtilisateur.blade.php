@extends('layouts.app_admin')

@section('content')
        <!-- PAGE CONTENT -->
    <div id="page-content-wrapper" class="w-100">
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom px-4">
        <span class="navbar-brand mb-0 h4 text-primary">Ajouter un utilisateur</span>
      </nav>

      <div class="container-fluid mt-4">
        <div class="card shadow">
          <div class="card-header bg-primary text-white">
            Formulaire d'ajout d'utilisateur
          </div>
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif

          <div class="card-body">
            <form method="POST" action="{{ isset($user) ? route('utilisateurs.update', $user->id) : route('utilisateurs.addUser') }}">
              @csrf
              @if(isset($user))
                @method('PUT')
              @endif


              <div class="mb-3">
                <label for="nom" class="form-label">Nom complet</label>
                <input type="text" class="form-control" value="{{ old('name', $user->name ?? '') }}" name="name" id="nom" placeholder="Ex : Jean Dupont" required />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" name="email" id="email" placeholder="exemple@domaine.com" required />
              </div>
              <div class="mb-3">
                <label for="motdepasse" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="motdepasse" placeholder="••••••••" required />
              </div>
              <div class="mb-3">
                <label for="role" class="form-label">Rôle</label>
                <select class="form-select" name="role" id="role" required>
                  <option value="">-- Choisir un rôle --</option>
                  <option value="secre1" {{ old('role', $user->role ?? '') == 'secre1' ? 'selected' : '' }}>Secrétaire 1</option>
                  <option value="secre2" {{ old('role', $user->role ?? '') == 'secre2' ? 'selected' : '' }}>Secrétaire 2</option>
                  <option value="dirc1" {{ old('role', $user->role ?? '') == 'dirc1' ? 'selected' : '' }}>directeur Miage</option>
                  <option value="dirc2" {{ old('role', $user->role ?? '') == 'dirc2' ? 'selected' : '' }}>Directeur UFR</option>
                  <option value="respo1" {{ old('role', $user->role ?? '') == 'respo1' ? 'selected' : '' }}>Responsable de Niveau</option>
                  <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>Etudiant</option>
                  <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                </select>
              </div>


              <div id="etudiant-fields" style="display: none;">
                <div class="mb-3">
                  <label for="prenom" class="form-label">Prénom</label>
                  <input type="text" class="form-control" value="{{ old('prenom', $user->prenom ?? '') }}" name="prenom" id="prenom" />
                </div>
                <div class="mb-3">
                  <label for="date_naissance" class="form-label">Date de naissance</label>
                  <input type="date" class="form-control" value="{{ old('date_naissance', $user->date_naissance ?? '') }}" name="date_naissance" id="date_naissance" />
                </div>
                <div class="mb-3">
                  <label for="matricule" class="form-label">Matricule</label>
                  <input type="text" class="form-control" value="{{ old('matricule', $user->matricule ?? '') }}" name="matricule" id="matricule" />
                </div>
                <div class="mb-3">
                  <label for="niveau" class="form-label">Niveau</label>
                  <input type="text" class="form-control" value="{{ old('niveau', $user->niveau ?? '') }}" name="niveau" id="niveau" />
                </div>
              </div>

              <div class="d-flex justify-content-between">
                <a href="{{route('listeUtillisateur')}}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Retour
                </a>
                <button type="submit" class="btn btn-success">
                  <i class="fas fa-save"></i> Enregistrer
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->



<script>
  
  window.addEventListener('DOMContentLoaded', function () {
    const role = document.getElementById('role');
    const fields = document.getElementById('etudiant-fields');
    if (role.value === 'user') {
      fields.style.display = 'block';
    }
  });



  document.getElementById('role').addEventListener('change', function () {
    let fields = document.getElementById('etudiant-fields');
    fields.style.display = this.value === 'user' ? 'block' : 'none';
  });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection



