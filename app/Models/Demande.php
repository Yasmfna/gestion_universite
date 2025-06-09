<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    
protected $table = 'demandes';

    // Champs remplissables
    protected $fillable = [
        'users_id',
        'demande_type_id',
        'etudiant_id',
        'statut',
        'est_soldee',
        'commentaire',
        'date_emission',
    ];

    // Types de données spécifiques
    protected $casts = [
        'est_soldee' => 'boolean',
        'date_emission' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relation avec User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    // Relation avec DemandeType
    public function demandeType()
    {
        return $this->belongsTo(DemandeType::class, 'demande_type_id');
    }

    // Relation avec Etudiant
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_id');
    }

}
