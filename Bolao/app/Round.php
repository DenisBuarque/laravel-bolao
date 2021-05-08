<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Betting;

class Round extends Model
{
    protected $fillable = [
        'betting_id', 'title', 'date_start', 'date_end', 'clock'
    ];

    // cria o relacionamento
    public function betting () 
    {
        return $this->belongsTo('App\Betting');
    }

    //cria a relação com o modelo Match.php
    public function matches()
    {
        return $this->hasMany('App\Match');
    }

    // cria o assessor
    public function bettingTitle($id) 
    {
        $betting = Betting::find($id);
        return $betting->title;
    }

    //cria o acessor e formata a data
    public function getDateStartFormatAttribute($value)
    {
        $date = date_create($value);
        return date_format($date,'d/m/Y'); 
    }

    //cria o acessor e formata a data
    public function getDateEndFormatAttribute($value)
    {
        $date = date_create($value);
        return date_format($date,'d/m/Y'); 
    }
}
