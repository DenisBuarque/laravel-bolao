<?php
namespace App\Repositories\Eloquent;

abstract class AbstractRepository
{
    protected $model;
    
    public function __construct()
    {
        $this->model = $this->resolverModel();
    }

    // Lista todos os usuários
    public function all($column = 'id', $order = 'ASC')
    {
        return $this->model->orderBy($column, $order)->get();
    }

    // Lista todos os usuário com paginação
    public function paginate($paginate = 10, $column = 'id', $order = 'ASC')
    {
        return $this->model->orderBy($column, $order)->paginate($paginate);
    }

    // Insere o usuário no banco
    public function create($dados)
    {
        return (bool) $this->model->create($dados);
    }

    // Altera o usuário no banco
    public function find($id)
    {
        return $this->model->find($id);
    }

    // Altera os dados no banco
    public function update($dados, $id)
    {
        $usuario = $this->find($id);
        if($usuario):
            return (bool) $usuario->update($dados);
        else:
            return false;
        endif;
    }

    // Deleta o registro do banco
    public function delete($id)
    {
        $usuario = $this->find($id);
        if($usuario):
            return (bool) $usuario->delete();
        else:
            return false;
        endif;
    }

    // Busca de usuário(s)
    public function findWereLike ($columns, $search, $column, $order)
    {
        $query = $this->model;
        foreach($columns as $key => $value):
            $query = $query->orWhere($value, 'like', '%'.$search.'%');
        endforeach;

        return $query->orderBy($column, $order)->get();
    }

    // Resolve o modelo -> User::class
    public function resolverModel()
    {
        return app($this->model);
    }
}