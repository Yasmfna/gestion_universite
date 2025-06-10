<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Page d'accueil - Maths Info Cocody</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <!-- CSS personnalisé -->
  <link href="{{asset('styles.css')}}" rel="stylesheet">
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="images/telechar.png" alt="Logo Maths Info" width="40" height="40" class="me-2">
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="#">Accueil</a></li>
          <li class="nav-item"><a class="nav-link" href="#apropos">À propos</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="{{route('login.connecter')}}"><i class="fas fa-sign-in-alt me-1"></i>Se connecter</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- SECTION ACCUEIL -->
  <div class="bg-cover d-flex justify-content-center align-items-center">
    <div class="container hero-text text-white">
      <h1>Bienvenue sur la plateforme MIAGE</h1>
      <p>Une solution moderne pour suivre vos demandes académiques</p>
      <a href="#apropos" class="btn btn-warning btn-lg mt-3">En savoir plus</a>
    </div>
  </div>

  <!-- SECTION À PROPOS -->
  <section id="apropos" class="section bg-light">
    <div class="container">
      <h2 class="text-center">À propos du Département</h2>
      <p class="lead text-center">
        Le Département de Mathématiques et Informatique (MI) de l’Université Félix Houphouët-Boigny de Cocody est l’un des piliers de la formation scientifique en Côte d’Ivoire.
      </p>
      <p class="text-center">
        Il propose des formations de qualité en Licence, Master et Doctorat, notamment dans les filières MIAGE (Méthodes Informatiques Appliquées à la Gestion des Entreprises), Informatique Fondamentale, et Actuariat.
        Grâce à un encadrement académique rigoureux et à des partenariats avec le monde professionnel, le département forme des experts capables de répondre aux défis numériques et technologiques de demain.
      </p>

      <hr class="my-5">

      <h3 class="text-center mb-4">Nos Réussites et Trophées</h3>
      <div class="row text-center">
        <div class="col-md-4 mb-4">
          <div class="trophy-card">
            <img src="images/MOOV.jpg" alt="Trophée Innovation 2023" class="img-fluid">
            <h5>Vainqueur de l'Hackathon de MOOV</h5>
            <p>Nos étudiants ont brillamment remporté l’Hackathon organisé par MOOV Africa, grâce à un projet innovant et impactant. Cette victoire témoigne de leur créativité, de leur esprit d’équipe et de leur capacité à proposer des solutions technologiques concrètes aux défis du monde réel.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="trophy-card">
            <img src="images/rennes.jpg" alt="Double diplomation" class="img-fluid">
            <h5>Deuxième promotion de la double diplomation Licence</h5>
            <p>Fruit du partenariat entre l’Université FHB et l’Université de Rennes, cette initiative permet à nos étudiants d’obtenir deux diplômes reconnus, renforçant ainsi leur employabilité sur le marché national et international.</p>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="trophy-card">
            <img src="images/WhatsApp Image 2025-06-07 à 21.43.19_0fd6c7e0.jpg" alt="Hackathon Universitaire" class="img-fluid">
            <h5>3ème Prix Hackathon Universitaire</h5>
            <p>Nos étudiants ont décroché le 3ᵉ prix lors du Hackathon interuniversitaire organisé à l’occasion de l’𝗔𝗙𝗥𝗜𝗖𝗔𝗡 𝗗𝗜𝗚𝗜𝗧𝗔𝗟 𝗪𝗘𝗘𝗞. Ce concours a rassemblé les meilleures équipes des grandes universités telles que l’INPHB, l’ESATIC, l’UFHB, l’UPB et l’Université Nanguy Abrogoua.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION CONTACT -->
  <section id="contact" class="section">
    <div class="container">
      <h2 class="text-center">Contact</h2>
      <p class="text-center">
        Département de Mathématiques et Informatique, Université FHB Cocody<br>
        Email : <a href="mailto:info@ufhb.ci">info@ufhb.ci</a> | Téléphone : (+225) 01 02 03 04 05
      </p>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="container">
      <p>2025 Département MI - Université de Cocody. Tous droits réservés.</p>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
