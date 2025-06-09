<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $table = 'etudiants';

    // Champs remplissables
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'date_naissance',
        'matricule',
        'niveau',
        'user_id',
        'statut_financier',
        'date_inscription',
    ];

    // Types de données spécifiques
    protected $casts = [
        'date_naissance' => 'date',
        'date_inscription' => 'date',
        'statut_financier' => 'boolean',
    ];

    // Relation avec User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation avec Demande
    public function demandes()
    {
        return $this->hasMany(Demande::class, 'etudiant_id');
    }
}
