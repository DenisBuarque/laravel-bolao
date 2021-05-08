<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = [
        'round_id', 'title', 'stadium', 'team_a', 'team_b', 'result', 'scoreboard_a', 'scoreboard_b', 'date'
    ];

    // cria arealação com o modelo Round.php
    public function rounds()
    {
        return $this->belongsTo('App\Round');
    }

    // cria o assessor de formatação da data
    public function getDateAttribute($value)
    {
        $date = date_create($value);
        return date_format($date, 'd/m/Y');
    }
}
