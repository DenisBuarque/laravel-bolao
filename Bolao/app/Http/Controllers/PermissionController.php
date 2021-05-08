<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\PermissionRepositoryInterface; //lembrar de registra no Provider\AppServiceProvider.php
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    private $model;

    public function __construct(PermissionRepositoryInterface $model)
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
            $permissao = $this->model->findWereLike(['name','description'], $search, 'id','DESC');
        else:
            $permissao = $this->model->paginate(3, 'id', 'DESC');
        endif;

        return view('admin.permissions.index', compact(['permissao','search']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
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
            'name' => 'required|string|max:20',
            'description' => 'required|string|max:50',
        ])->validate();

        // chama a função 'create' criado em App\Repositories\Eloqente\AbstractRepository.php
        if($this->model->create($dados)):
            $request->session()->flash('alert', 'Registro adicionado com sucesso!'); // mensagem de alerta
            return redirect()->route('admin.permissions.index');
        else:
            $request->session()->flash('alert', 'Erro ao adicionar o registro!');  // mensagem de alerta
            return redirect()->back();
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
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
        $permissao = $this->model->find($id);
        if($permissao):
            return view('admin.permissions.edit', compact(['permissao']) );
        endif;

        // se não encontrou o registro
        session()->flash('alert', 'Opss! Não encontrado o registro, tente outra vez!'); // msg de alerta
        // redireciona para lista de registros
        return redirect()->route('admin.permissions.index');        
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
            'name' => 'required|string|max:20',
            'description' => 'required|string|max:50',
        ])->validate();

        

        // chama a função 'update' criado em App\Repositories\Eloqente\AbstractRepository.php
        if($this->model->update($dados, $id)):
            $request->session()->flash('alert', 'Registro alterado com sucesso!'); // mensagem de alerta
            return redirect()->route('admin.permissions.index');
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

        return redirect()->route('admin.permissions.index');
    }
}
