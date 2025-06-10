<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprobationSuivi extends Model
{
    protected $table = 'approbation_suivis';

    protected $fillable = [
        'demande_id',
        'approbation_demande_id',
        'user_id',
        'statut',
        'commentaire',
        'date_approbation',
    ];

    protected $dates = [
        'date_approbation',
        'created_at',
        'updated_at',
    ];

    // Relations

    public function demande()
    {
        return $this->belongsTo(Demande::class, 'demande_id');
    }

    public function approbationDemandeType()
    {
        return $this->belongsTo(ApprobationDemandeType::class, 'approbation_demande_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
