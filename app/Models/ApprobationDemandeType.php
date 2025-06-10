<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprobationDemandeType extends Model
{
    protected $fillable = ['demande_type_id', 'approbation_id', 'ordre'];
}
