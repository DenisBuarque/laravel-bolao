<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Role;

class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{
    protected $model = Role::class;

    // aqui fica as funções que pertenção somente a esse modelo...
    // Insere o usuário no banco
    public function create($dados)
    {
        // Primeiramente cria o registro vindo do formuláro depois faz o relacionamento
        $registros = $this->model->create($dados);
        // se existe alguma permissão selecionada
        if(isset($dados['permissions']) && count($dados['permissions']))
        {
            foreach($dados['permissions'] as $key => $value):
                // chama a função permissions do modelo Role.php e cria o relaciomaneto entre Role e Permissions
                $registros->permissions()->attach($value);
            endforeach;
        }
        return (bool) $registros;
    }

    // Altera os dados no banco
    public function update($dados, $id)
    {
        $registros = $this->find($id);
        if($registros):
            // pega lisat de permissões do relaciomento
            $permissions = $registros->permissions;
            if(count($permissions)){
                foreach($permissions as $key => $value):
                    // chama a função permissions do modelo Permission.php e usa detach() apara apaga registro
                    $registros->permissions()->detach($value->id);
                endforeach;
            }

            // se existe alguma permissão selecionada
            if(isset($dados['permissions']) && count($dados['permissions']))
            {
                foreach($dados['permissions'] as $key => $value):
                    // chama a função permissions do modelo Role.php e cria o relaciomaneto entre Role e Permissions
                    $registros->permissions()->attach($value);
                endforeach;
            }

            return (bool) $registros->update($dados);

        else:
            return false;
        endif;
    }
    
}