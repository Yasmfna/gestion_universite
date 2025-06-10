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
        }

        h2 {
            text-align: center;
            text-decoration: underline;
            font-size: 20px;
            margin-bottom: 40px;
        }

        p {
            line-height: 1.6;
            text-align: justify;
        }

        .signature {
            position: absolute;
            bottom: 100px;
            right: 80px;
            width: 120px;
        }

        .cachet {
            position: absolute;
            bottom: 80px;
            left: 80px;
            width: 100px;
            opacity: 0.7;
        }

        .footer-text {
            position: absolute;
            bottom: 40px;
            left: 80px;
            font-size: 12px;
            color: #333;
        }
    </style>
</head>
<body>
    <h2>ATTESTATION DE RÉUSSITE</h2>

    <p>Le Directeur de l'UFR certifie que :</p>

    <p><strong>{{ $etudiant->nom }} {{ $etudiant->prenom }}</strong>, né(e) le {{ \Carbon\Carbon::parse($etudiant->date_naissance)->format('d/m/Y') }}, 
    matricule {{ $etudiant->matricule }}, a été admis(e) avec succès à la formation de type 
    <strong>{{ $demande->type }}</strong> durant l’année universitaire <strong>{{ $demande->annee }}</strong>.</p>

    <p>En foi de quoi, la présente attestation lui est délivrée pour servir et valoir ce que de droit.</p>

    <p>Fait à Abidjan, le {{ \Carbon\Carbon::now()->format('d/m/Y') }}.</p>

    <img class="signature" src="{{ public_path('images/signature_directeur.png') }}" alt="Signature">
    
    <div class="footer-text">UFR Mathématiques et Informatique – Université Félix Houphouët-Boigny</div>
</body>
</html>
