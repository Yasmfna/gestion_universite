<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class documentsRequis extends Model
{
    
    protected $table = 'document_requis';

    protected $fillable = [
        'nom',
        'description',
        'type',
    ];
}
