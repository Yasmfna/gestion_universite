<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeType extends Model
{
    protected $table = 'demande_types';

    // Champs remplissables
    protected $fillable = [
        'nom',
        'description',
        'regles',
    ];

    // Types de données spécifiques
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relation avec Demande
    public function demandes()
    {
        return $this->hasMany(Demande::class, 'demande_type_id');
    }
}
