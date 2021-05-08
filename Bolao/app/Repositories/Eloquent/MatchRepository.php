<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\MatchRepositoryInterface;
use App\Match;

class MatchRepository extends AbstractRepository implements MatchRepositoryInterface
{
    protected $model = Match::class;

    // aqui fica as funções que pertenção somente a esse modelo...

    // Insere o usuário no banco
    /*public function create($dados)
    {
        
        $user = auth()->user();
        $list_round = $user->rounds; // chama o assessor getRoundsAttribute() no modelo User.php
        $round_id = $dados['round_id'];
        $exist = false;
        foreach($list_round as $key => $value):
            if($round_id == $value->id){
                $exist = true;
            }
        endforeach;

        if($exist){
            return (bool) $this->model->create($dados);
        }else{
            return false;
        }
        
    }*/

    // Altera o usuário no banco
    /*public function find($id)
    {
        return $this->model->find($id);
    }*/

    // Altera os dados no banco
    /*public function update($dados, $id)
    {
        $usuario = $this->find($id);
        if($usuario):

            $user = auth()->user();
            $list_round = $user->rounds; // chama o assessor getRoundsAttribute() no modelo User.php
            $round_id = $dados['round_id'];
            $existe = false;
            foreach($list_round as $key => $value):
                if($round_id == $value->id){
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
    }*/
    
}