<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Model;

   class Approbation extends Model
   {
       protected $fillable = ['titre', 'description', 'statut', 'role_user_id'];
   }