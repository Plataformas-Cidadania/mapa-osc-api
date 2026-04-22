<?php


namespace App\Services\Portal;


use App\Repositories\Portal\RepresentacaoRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RepresentacaoService
{
    private $repo;

    public function __construct(RepresentacaoRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id)
    {
        return $this->repo->get($id);
    }

    public function getRepresetacaoPorOscAndUsuario($id_osc, $id_usuario)
    {
        return $this->repo->getRepresetacaoPorOscAndUsuario($id_osc, $id_usuario);
    }

    public function getRepresetacaoPorCnpjOsc($cnpj_osc)
    {
        return $this->repo->getRepresetacaoPorCnpjOsc($cnpj_osc);
    }

    public function store(array $data)
    {
        $data['id_usuario'] = Auth::user()->id_usuario;
        return $this->repo->store($data);
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete($id_osc)
    {
        $id_usuario = Auth::user()->id_usuario;
        $representacao = $this->repo->getRepresetacaoPorOscAndUsuario($id_osc, $id_usuario);
        //Log::info($representacao);
        return $this->repo->destroy($representacao->id_representacao);
    }

    public function deletePorOscAndUser($id_osc, $id_usuario)
    {
        $usuario = Auth::user();
//        dd($usuario->tx_email_usuario);
        if ($usuario->tx_email_usuario === "thiago.ramos@ipea.gov.br") {

            $representacao = $this->repo->getRepresetacaoPorOscAndUsuario($id_osc, $id_usuario);
            //Log::info($representacao);
            return $this->repo->destroy($representacao->id_representacao);
        }

        return false;
    }

    public function getRepresetacoesPorUsuario($id_usuario)
    {
        return $this->repo->getRepresetacoesPorUsuario($id_usuario);
    }
}

