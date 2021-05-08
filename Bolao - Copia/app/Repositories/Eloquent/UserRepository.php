<?php
namespace App\Repositories\Eloquent;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected $model = User::class;

    // Insere o usuário no banco
    public function create($dados)
    {
        $dados['password'] = bcrypt($dados['password']);
        // Primeiramente cria o registro vindo do formuláro depois faz o relacionamento
        $registros = $this->model->create($dados);
        // se existe alguma permissão selecionada
        if(isset($dados['roles']) && count($dados['roles']))
        {
            foreach($dados['roles'] as $key => $value):
                // chama a função roles do modelo User.php e cria o relaciomaneto entre User e Role
                $registros->roles()->attach($value);
            endforeach;
        }
        return (bool) $registros;

    }

    // Altera os dados no banco
    public function update($dados, $id)
    {
        
        $registros = $this->find($id);
        if($registros):

            $roles = $registros->roles; // pega lista de roles vindo o formulario
            if(count($roles)){
                foreach($roles as $key => $value):
                    // chama a função roles do modelo Role.php e usa detach() apara apaga registro
                    $registros->roles()->detach($value->id); 
                endforeach;
            }

            // se existe alguma role selecionada
            if(isset($dados['roles']) && count($dados['roles']))
            {
                foreach($dados['roles'] as $key => $value):
                    // chama a função roles do modelo User.php e cria o relaciomaneto entre User e Role
                    $registros->roles()->attach($value);
                endforeach;
            }

            if(empty($dados['password'])):
                unset($dados['password']);
            else:
                $dados['password'] = bcrypt($dados['password']);    
            endif;

            return (bool) $registros->update($dados);

        else:
            return false;
        endif;

    }

}