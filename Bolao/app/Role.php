<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    // Cria um relacionamento n p/ n (Role p/ User)
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    // Cria um relacionamento n p/ n (Role p/ Permission)
    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }
}
