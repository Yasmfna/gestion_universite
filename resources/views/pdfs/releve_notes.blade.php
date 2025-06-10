@php
    // Simulation des matières par semestre, classées en UE majeures et mineures
    $semestres = [
        'Semestre 1' => [
            'UE Majeures' => [
                ['nom' => 'Analyse I', 'credit' => 4],
                ['nom' => 'Algèbre Linéaire I', 'credit' => 4],
                ['nom' => 'Programmation C', 'credit' => 5],
                ['nom' => 'Algorithmique', 'credit' => 4],
                ['nom' => 'Systèmes d\'exploitation', 'credit' => 3],
            ],
            'UE Mineures' => [
                ['nom' => 'Anglais I', 'credit' => 2],
                ['nom' => 'Communication', 'credit' => 2],
                ['nom' => 'Méthodologie', 'credit' => 2],
                ['nom' => 'Projet tutoré I', 'credit' => 2],
            ],
        ],
        'Semestre 2' => [
            'UE Majeures' => [
                ['nom' => 'Analyse II', 'credit' => 4],
                ['nom' => 'Algèbre II', 'credit' => 4],
                ['nom' => 'Programmation Python', 'credit' => 5],
                ['nom' => 'Base de données', 'credit' => 3],
                ['nom' => 'Réseaux informatiques', 'credit' => 4],
            ],
            'UE Mineures' => [
                ['nom' => 'Anglais II', 'credit' => 2],
                ['nom' => 'Droit informatique', 'credit' => 2],
                ['nom' => 'Projet tutoré II', 'credit' => 2],
                ['nom' => 'Développement Web', 'credit' => 2],
            ],
        ],
    ];

    // Fonction pour simuler une note entre 5 et 20
    function simulerNote() {
        return rand(50, 200) / 10; // exemple : 5.0 à 20.0
    }

    // Calcul du total de crédits validés
    $totalCredits = 0;

    // Générer un tableau avec notes simulées et validation
    $resultats = [];

    foreach ($semestres as $semestre => $ues) {
        $resultats[$semestre] = [];
        foreach ($ues as $ueType => $matieres) {
            $resultats[$semestre][$ueType] = [];
            foreach ($matieres as $matiere) {
                $note = simulerNote();
                $valide = $note >= 10;
                if ($valide) {
                    $totalCredits += $matiere['credit'];
                }
                $resultats[$semestre][$ueType][] = [
                    'nom' => $matiere['nom'],
                    'credit' => $matiere['credit'],
                    'note' => number_format($note, 1),
                    'valide' => $valide,
                ];
            }
        }
    }
@endphp

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 60px;
            font-size: 13px;
        }
        h1, h2, h3 { text-align: center; margin: 0; }
        h1 { font-size: 18px; }
        h2 { font-size: 16px; margin-bottom: 20px; }
        .info { margin: 20px 0; }
        .info p { margin: 5px 0; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 25px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        th { background-color: #f0f0f0; }
        .ue-header {
            background-color: #ddd;
            font-weight: bold;
            text-align: left;
            padding: 6px;
        }
        .signature {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
        }
        .signature img {
            width: 120px;
        }
        .footer {
            font-size: 12px;
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Université Félix Houphouët-Boigny</h1>
<h2>UFR Mathématiques et Informatique</h2>
<h3>RELEVÉ DE NOTES - {{ $etudiant->niveau }}</h3>

<div class="info">
    <p><strong>Nom :</strong> {{ $etudiant->nom }} {{ $etudiant->prenom }}</p>
    <p><strong>Matricule :</strong> {{ $etudiant->matricule }}</p>
    <p><strong>Année universitaire :</strong> {{ $anneeUniversitaire ?? '2024-2025' }}</p>
</div>

@foreach($resultats as $semestre => $ues)
    <h3>{{ $semestre }}</h3>

    @foreach($ues as $ueType => $matieres)
        <div class="ue-header">{{ $ueType }}</div>
        <table>
            <thead>
                <tr>
                    <th>Matière</th><th>Note /20</th><th>Crédit</th><th>Validé</th>
                </tr>
            </thead>
            <tbody>
                @foreach($matieres as $matiere)
                    <tr>
                        <td>{{ $matiere['nom'] }}</td>
                        <td>{{ $matiere['note'] }}</td>
                        <td>{{ $matiere['credit'] }}</td>
                        <td>{{ $matiere['valide'] ? 'Oui' : 'Non' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
@endforeach

@php
    $resultatFinal = $totalCredits >= 60 ? 'Admis' : 'Ajourné';
@endphp

<p><strong>Total des crédits validés :</strong> {{ $totalCredits }} / 60</p>
<p><strong>Résultat :</strong> {{ $resultatFinal }}</p>

<div class="signature">
    <div>
        <img src="{{ public_path('images/cachet_ufr.png') }}" alt="Cachet">
    </div>
    <div>
        <img src="{{ public_path('images/signature_directeur.png') }}" alt="Signature">
    </div>
</div>

<div class="footer">
    UFR Mathématiques et Informatique – Université Félix Houphouët-Boigny – Abidjan
</div>

</body>
</html>
