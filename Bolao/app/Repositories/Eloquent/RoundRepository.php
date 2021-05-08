<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoundRepositoryInterface;
use App\Round;

class RoundRepository extends AbstractRepository implements RoundRepositoryInterface
{
    protected $model = Round::class;

    // aqui fica as funções que pertenção somente a esse modelo...

    // Insere o usuário no banco
    public function create($dados)
    {
        
        $user = auth()->user();
        $list_betting = $user->bettings;
        $betting_id = $dados['betting_id'];
        $existe = false;
        foreach($list_betting as $key => $value):
            if($betting_id == $value->id){
                $existe = true;
            }
        endforeach;

        if($existe){
            return (bool) $this->model->create($dados);
        }else{
            return false;
        }

        
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

            $user = auth()->user();
            $list_betting = $user->bettings;
            $betting_id = $dados['betting_id'];
            $existe = false;
            foreach($list_betting as $key => $value):
                if($betting_id == $value->id){
                    $existe = true;
                }
            endforeach;
    
            if($existe){
                return (bool) $usuario->update($dados);
            }else{
                return false;
            }

           
        else:
            return false;
        endif;
    }
    
}