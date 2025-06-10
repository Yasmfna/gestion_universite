<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            margin: 60px;
            position: relative;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            margin: 0;
        }

        .header h2 {
            font-size: 16px;
            margin: 0;
            font-weight: normal;
        }

        .line {
            border-top: 2px solid #000;
            margin: 20px 0;
        }

        h2.title {
            text-align: center;
            text-decoration: underline;
            font-size: 22px;
            margin-bottom: 40px;
        }

        p {
            line-height: 1.8;
            text-align: justify;
            margin: 12px 0;
        }

        .signature {
            position: absolute;
            bottom: 100px;
            right: 80px;
            width: 130px;
        }

        .cachet {
            position: absolute;
            bottom: 90px;
            left: 80px;
            width: 100px;
            opacity: 0.7;
        }

        .footer-text {
            position: absolute;
            bottom: 40px;
            left: 80px;
            font-size: 12px;
            color: #444;
        }

        .etudiant-info {
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Université Félix Houphouët-Boigny</h1>
        <h2>UFR Mathématiques et Informatique</h2>
    </div>

    <div class="line"></div>

    <h2 class="title">ATTESTATION DE FRÉQUENTATION</h2>

    <p>Le Directeur de l'UFR Mathématiques et Informatique certifie que :</p>

    <p class="etudiant-info">
        {{ $etudiant->nom }} {{ $etudiant->prenom }},
        né(e) le {{ \Carbon\Carbon::parse($etudiant->date_naissance)->format('d/m/Y') }},
        matricule {{ $etudiant->matricule }},
        est régulièrement inscrit(e) en <strong>{{ $etudiant->niveau }}</strong>
        pour l’année universitaire <strong>{{ $demande->annee }}</strong>.
    </p>

    <p>En foi de quoi, la présente attestation lui est délivrée pour servir et valoir ce que de droit.</p>

    <p>Fait à Abidjan, le {{ \Carbon\Carbon::now()->format('d/m/Y') }}.</p>

    <img class="signature" src="{{ public_path('images/signature_directeur.png') }}" alt="Signature du Directeur">
    <img class="cachet" src="{{ public_path('images/cachet_ufr.png') }}" alt="Cachet officiel">

    <div class="footer-text">UFR Mathématiques et Informatique – Université Félix Houphouët-Boigny – Cocody, Abidjan</div>
</body>
</html>
