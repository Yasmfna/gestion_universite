<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\documentsRequis;
class DocumentDemandeType extends Model
{
    protected $table = 'document_demande_type';

    protected $fillable = [
        'document_requis_id',
        'demande_types_id',
    ];

    public $timestamps = true;   

    public function documentRequis()
{
    return $this->belongsTo(documentsRequis::class, 'document_requis_id');
}
}
