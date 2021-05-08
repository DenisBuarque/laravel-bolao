<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    // Cria um relacionamento n p/ n (Permission p/ Role)
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
