<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface; //lembrar de registra no Provider\AppServiceProvider.php
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $model;
    private $modelRole;

    public function __construct(UserRepositoryInterface $model, RoleRepositoryInterface $modelRole)
    {
        //$this->middleware('auth'); // autenticação de usuário
        $this->model = $model;
        $this->modelRole = $modelRole;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        //$this->authorize('access-user'); // autoriza a nivel de @can('access-user')
       
        
        $search = '';
        if(isset($request->search)) :
            $search = $request->search;
            $usuarios = $this->model->findWereLike(['name','email'], $search, 'id','DESC');
        else:
            $usuarios = $this->model->paginate(3, 'id', 'DESC');
        endif;

        return view('admin.users.index', compact(['usuarios','search']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->modelRole->all('name', 'ASC');
        return view('admin.users.create', compact('roles'));
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
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|unique:users|max:100',
            'password' => 'required|string|min:6|confirmed',
        ])->validate();

        // chama a função 'create' criado em App\Repositories\Eloqente\AbstractRepository.php
        if($this->model->create($dados)):
            $request->session()->flash('alert', 'Registro adicionado com sucesso!'); // mensagem de alerta
            return redirect()->route('admin.users.index');
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
        // chama a função 'find' criado em App\Repositories\Eloqente\AbstractRepository.php
        $usuario = $this->model->find($id);
        if($usuario):
            return view('admin.users.show', compact(['usuario']) );
        endif;
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
        $usuario = $this->model->find($id);
        if($usuario):
            $roles = $this->modelRole->all('name', 'ASC');
            return view('admin.users.edit', compact(['usuario','roles']) );
        endif;

        // se não encontrou o registro
        session()->flash('alert', 'Opss! Não encontrado o registro, tente outra vez!'); // msg de alerta
        // redireciona para lista de registros
        return redirect()->route('admin.users.index');        
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

        if(!$dados['password']):
            unset($dados['password']);
        endif;

        // validação de campos do formulário
        Validator::make($dados, [
            'name' => 'required|string|max:50',
            'email' => ['required','string','email','max:100',Rule::unique('users')->ignore($id)],
            'password' => 'sometimes|required|string|min:6|confirmed',
        ])->validate();

        // chama a função 'update' criado em App\Repositories\Eloqente\AbstractRepository.php
        if($this->model->update($dados, $id)):
            $request->session()->flash('alert', 'Registro alterado com sucesso!'); // mensagem de alerta
            return redirect()->route('admin.users.index');
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

        return redirect()->route('admin.users.index');
    }
}
