






@extends('layouts.app_user')

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                       
                       <div class="row justify-content-center">
                       <div class="col-md-8">
                         <div class="card shadow-sm">
                           <div class="card-header bg-primary text-white d-flex align-items-center">
                             <i class="fas fa-user-circle me-2"></i>
                             <h5 class="mb-0">Mon Profil</h5>
                           </div>
                           <div class="card-body text-center">
                             <!-- Photo de profil -->
                             <div class="mb-3">
                               <img src="https://via.placeholder.com/120" alt="Photo de profil"
                                 class="rounded-circle shadow-sm" style="width: 120px; height: 120px; object-fit: cover;">
                               <div>
                                 <a href="#" class="text-primary small mt-2 d-block">Changer la photo</a>
                               </div>
                             </div>
           
                             <form id="profilForm" class="text-start">
                               <div class="mb-3">
                                 <label for="nom" class="form-label">Nom</label>
                                 <input type="text" class="form-control" id="nom" value="KOUADIO" disabled>
                               </div>
                               <div class="mb-3">
                                 <label for="prenom" class="form-label">Prénom</label>
                                 <input type="text" class="form-control" id="prenom" value="YAO" disabled>
                               </div>
                               <div class="mb-3">
                                 <label for="matricule" class="form-label">Matricule</label>
                                 <input type="text" class="form-control" id="matricule" value="MIAGE2025-0012" disabled>
                               </div>
                               <div class="mb-3">
                                 <label for="email" class="form-label">Adresse email</label>
                                 <input type="email" class="form-control" id="email" value="yao.kouadio@univ-cocody.edu.ci" disabled>
                               </div>
                               <div class="mb-3">
                                 <label for="telephone" class="form-label">Téléphone</label>
                                 <input type="text" class="form-control" id="telephone" value="+225 0707070707" disabled>
                               </div>
           
                               <div class="text-end">
                                 <button type="button" class="btn btn-outline-primary" id="editBtn">
                                   <i class="fas fa-edit me-1"></i>Modifier
                                 </button>
                                 <button type="submit" class="btn btn-primary d-none" id="saveBtn">
                                   <i class="fas fa-save me-1"></i>Enregistrer
                                 </button>
                               </div>
                             </form>
                           </div>
                         </div>
                       </div>
                       </div>
           
           
                 </main>

                 <script>
  const editBtn = document.getElementById('editBtn');
  const saveBtn = document.getElementById('saveBtn');
  const inputs = document.querySelectorAll('#profilForm input');

  editBtn.addEventListener('click', () => {
    inputs.forEach(input => input.disabled = false);
    editBtn.classList.add('d-none');
    saveBtn.classList.remove('d-none');
  });

  document.getElementById('profilForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Exemple de validation ou envoi backend ici

    inputs.forEach(input => input.disabled = true);
    saveBtn.classList.add('d-none');
    editBtn.classList.remove('d-none');
    alert('Modifications enregistrées.');
  });
</script>
      @endsection
