<?php


namespace App\Repositories\Portal;

use App\Models\Portal\Representacao;
use Illuminate\Database\Eloquent\Model;

use App\Util\FormatacaoUtil;

class RepresentacaoRepositoryEloquent implements RepresentacaoRepositoryInterface
{
    private $model;

    public function __construct(Representacao $_representacao)
    {
        $this->model = $_representacao;
    }

    public function getAll()
    {
        return $this->model->with('osc')->with('usuario')->get();//->whereIn('id_representacao', [1, 250, 251]);//->orderBy('id_representacao', 'asc');
    }

    public function get($id)
    {
        return $this->model->with('usuario')->with('osc')->where('id_representacao', $id)->get();
    }

    public function getRepresetacaoPorOscAndUsuario($id_osc, $id_usuario)
    {
        return $this->model->with('usuario')
            ->with('osc')
            ->where('id_osc', $id_osc)
            ->where('id_usuario', $id_usuario)
            ->first();
    }

    public function getRepresetacaoPorCnpjOsc($cnpj_osc)
    {
//        return $this->model->with('usuario')
//            ->with('osc')
//            ->where('cd_identificador_osc', $cnpj_osc)
//            ->first();

//        return $this->model->with('usuario')
//            ->with('osc')
//            ->where('cd_identificador_osc', $cnpj_osc)
//            ->get()
//            ->map(function($representacao) {
//                return $representacao->usuario;
//            });

        return $this->model->with('usuario')
            ->join('osc.tb_osc', 'portal.tb_representacao.id_osc', '=', 'osc.tb_osc.id_osc')
            ->where('osc.tb_osc.cd_identificador_osc', $cnpj_osc)
            ->get()
            ->map(function($representacao) {
                $usuario = $representacao->usuario;
                $dados = [
                    'id_usuario' => $usuario->id_usuario,
                    'tx_nome_usuario' => $usuario->tx_nome_usuario,
                    'tx_email_usuario' => (new FormatacaoUtil())->mascararEmail($usuario->tx_email_usuario)
                ];
                return $dados;
            });
    }



    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        return $this->model->find($id)->delete();
    }
}
