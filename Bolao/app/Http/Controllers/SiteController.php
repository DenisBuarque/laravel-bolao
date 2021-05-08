<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\BettingRepositoryInterface;

class SiteController extends Controller
{
    public function listSite(BettingRepositoryInterface $betting_repository)
    {
        $lista_apostas = $betting_repository->listbettings();
        return view('welcome', compact('lista_apostas'));
    }

    public function sign(BettingRepositoryInterface $betting_repository, $id)
    {
        $betting_repository->bettingUser($id); //cria o relacionamento
        return redirect()->route('welcome');
    }

    public function signNoLogin($id)
    {
        return redirect()->route('welcome');
    }

    public function rounds(BettingRepositoryInterface $betting_repository, $betting_id)
    {
        $rodadas = $betting_repository->rounds($betting_id);
        $title_aposta = $betting_repository->find($betting_id);
        return view('rounds', compact(['rodadas','title_aposta']));
    }

    public function matches(BettingRepositoryInterface $betting_repository, $round_id)
    {
        $list = $betting_repository->matches($round_id); // acessa o metodo matches do betting repository
        dd($list->toArray());
        return 'ok';
    }
}
