<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\MatchRepositoryInterface; //lembrar de registra no Provider\AppServiceProvider.php
use Illuminate\Support\Facades\Validator;
use App\Betting;
use App\Round;

class MatchController extends Controller
{
    private $model;

    public function __construct(MatchRepositoryInterface $model)
    {
        //$this->middleware('auth'); // autenticação de usuário
        $this->model = $model;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = '';
        if(isset($request->search)) :
            $search = $request->search;
            // chama a função 'findWhereLike' do App\Repositories\Eloquent\AbstractRepository.php
            $partidas = $this->model->findWereLike(['title','stadium','team_a','team_b'], $search, 'id','DESC');
        else:
            $partidas = $this->model->paginate(3, 'id', 'DESC');
        endif;

        return view('admin.matches.index', compact(['partidas','search']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$user = auth()->user();
        //$list_rounds = $user->rounds; // chama o assessor getRoundsAttribute() do model User.php
        $list_rounds = Round::all();
        return view('admin.matches.create', compact('list_rounds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // pega todos os dados vindos do formulário
        $dados = $request->all();

        // validação de campos do formulário
        Validator::make($dados, [
            'round_id' => 'required',
            'title' => 'required|string|max:50',
            'team_a' => 'required',
            'team_b' => 'required',
            'result' => 'required',
            'scoreboard_a' => 'required',
            'scoreboard_b' => 'required',
            'date' => 'required',
        ])->validate();

        // chama a função 'create' criado em App\Repositories\Eloqente\AbstractRepository.php
        if($this->model->create($dados)):
            $request->session()->flash('alert', 'Registro adicionado com sucesso!'); 
            return redirect()->route('admin.matches.index');
        else:
            $request->session()->flash('alert', 'Erro ao adicionar o registro!');
            return redirect()->back();
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $partida = $this->model->find($id);
        if($partida):
            return view('admin.matches.show', compact('partida'));
        endif;

        return redirect()->rount("admin.matches.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // chama a função 'find' criado em App\Repositories\Eloqente\AbstractRepository.php
        $partida = $this->model->find($id);
        if($partida):
            //$user = auth()->user();
            //$list_bettings = $user->bettings; // chama o assessor bettings() do model User.php
            $list_rounds = Round::all();
            return view('admin.matches.edit', compact(['partida', 'list_rounds']) );
        endif;

        // se não encontrou o registro
        session()->flash('alert', 'Opss! Não encontrado o registro, tente outra vez!'); // msg de alerta
        // redireciona para lista de registros
        return redirect()->route('admin.matches.index');  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // pega todos os dados vindos do formulário
        $dados = $request->all();

        // validação de campos do formulário
        Validator::make($dados, [
            'round_id' => 'required',
            'title' => 'required|string|max:50',
            'team_a' => 'required',
            'team_b' => 'required',
            'result' => 'required',
            'scoreboard_a' => 'required',
            'scoreboard_b' => 'required',
            'date' => 'required',
        ])->validate();

        // chama a função 'update' criado em App\Repositories\Eloqente\AbstractRepository.php
        if($this->model->update($dados, $id)):
            $request->session()->flash('alert', 'Registro alterado com sucesso!'); // mensagem de alerta
            return redirect()->route('admin.matches.index');
        else:
            $request->session()->flash('alert', 'Erro ao alterar o registro!');  // mensagem de alerta
            return redirect()->back();
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // chama a função 'delete' criado em App\Repositories\Eloqente\AbstractRepository.php
        if($this->model->delete($id)):
            $request->session()->flash('alert', 'Registro excluído com sucesso!');  // mensagem de alerta
        else:
            $request->session()->flash('alert', 'Erro!');
        endif;

        return redirect()->route('admin.matches.index');
    }
}
