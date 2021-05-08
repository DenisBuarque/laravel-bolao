<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\BettingRepositoryInterface;
use App\Betting;
use App\Round;

class BettingRepository extends AbstractRepository implements BettingRepositoryInterface
{
    protected $model = Betting::class;

    // aqui fica as funções que pertenção somente a esse modelo...

    public function listbettings()
    {
        $list = Betting::all();
        $user = Auth()->user();
        if($user){
            $myBetting = $user->myBetting;
            foreach($list as $key => $value){
                if($myBetting->contains($value)){ // 'contains' verifica se existe no array
                    $value->subscriber = true; // cria um atributo
                }
            }
        }
        return $list;
    }

    // Insere o usuário no banco
    public function create($dados)
    {
        $user = Auth()->user();
        $dados['user_id'] = $user->id;
        return (bool) $this->model->create($dados);
    }

    // Altera os dados no banco
    public function update($dados, $id)
    {
        $usuario = $this->find($id);
        if($usuario):
            $user = Auth()->user(); // pega o usuário logado no momento
            $dados['user_id'] = $user->id;
            return (bool) $usuario->update($dados);
        else:
            return false;
        endif;
    }

    public function bettingUser($id)
    {
        $user = Auth()->user(); // pega o usuário logado no momento
        $betting = Betting::find($id);
        if($betting){
            $relaciona = $user->myBetting()->toggle($betting->id); // toogle cria relaciona 2 objetos
            if(count($relaciona['attached'])){ // verifica se esta relacionado 'attached'
                return true;
            }
        }
        return false;
    }

    public function rounds($betting_id)
    {
        $user = Auth()->user(); // pega o usuário logado no momento
        $betting = $user->myBetting()->find($betting_id);

        if($betting){
            return $betting->round()->orderBy('date_start','DESC')->get();
        }
        return false;
    }

    public function matches($round_id)
    {
        $user = Auth()->user(); // pega o usuário logado no momento
        $round = Round::find($round_id);
        $betting_id = $round->betting->id; // chama o metodo betting() do modelo Round.php e pega id
        $betting = $user->myBetting->find($betting_id);
        if($betting){
            return $round->matches()->orderBy('date', 'DESC')->get(); // faz o relacionamento com partidas
        }
        return false;
    }
    
}