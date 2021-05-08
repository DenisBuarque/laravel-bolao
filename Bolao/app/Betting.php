<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Betting extends Model
{
    protected $fillable = [
        'user_id', // id do usuário
        'title', // titulo da partida
        'current_round', // rodada atual
        'value_result', // valor resultado
        'extra_value', // valor taxa extra
        'value_fee', // valor da taxa
    ];

    // cria o realciomaneto n p/ 1 (Betting p/ User)
    public function users()
    {
        return $this->belongsTo('App\User');
    }
    // cria o assessor
    public function nameUser($id)
    {
        $user = User::find($id);
        return $user->name;
    }

    //assessor transforma o title em minsculo e coloca primeira letra em maisculo 
    public function getTitleAttribute($value)
    {
        return ucwords(mb_strtolower($value, 'UTF-8')); 
    }

    // cria o relacionamento
    public function round()
    {
        return $this->hasMany('App\Round');
    }

    public function bettors()
    {
        return $this->belongsToMeny('App\User');
    }
}
