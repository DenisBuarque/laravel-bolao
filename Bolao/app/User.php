<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Arr;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Cria um relacionamento n p/ n (User p/ Role)
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    // cria um realcioamento de 1 p/ n (User p/ Betting)
    public function bettings()
    {
        return $this->hasMany('App\Betting');
    }

    public function hasRoles($roles)
    {
        $userRoles = $this->roles;
        return $roles->intersect($userRoles)->count();
    }

    //cria o assessor de Round pegando as partidas das rodadas
    public function getRoundsAttribute()
    {
        $bettings = $this->bettings; // pega as partidasdo usuário
        $rounds = [];
        foreach($bettings as $key => $value):
            $rounds[] = $value->user_id;
        endforeach;
 
        return Arr::collapse($rounds);
    }

    public function myBetting()
    {
        return $this->belongsToMany('App\Betting');
    }
}
