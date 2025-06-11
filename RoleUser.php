<?php

namespace App\Models;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\approbations;

class RoleUser extends Model
{
    protected $table = 'role_user';

    protected $fillable = ['role_id', 'user_id'];

    public $timestamps = true;

    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
    
}
public function role()
{
    return $this->belongsTo(Roles::class, 'role_id');
}
public function approbations()
{
    return $this->hasMany(approbations::class, 'role_user_id');
}

}
