<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class approbations extends Model
{
    protected $table = 'approbations';

    protected $fillable = [
        'titre',
        'description',
        'statut',
        'role_user_id',
    ];
    public function roleUser()
{
    return $this->belongsTo(RoleUser::class, 'role_user_id');
}
public function demandeTypes()
{
    return $this->belongsToMany(DemandeType::class, 'approbation_demande_type')
                ->withPivot('ordre')
                ->withTimestamps();
}
}
