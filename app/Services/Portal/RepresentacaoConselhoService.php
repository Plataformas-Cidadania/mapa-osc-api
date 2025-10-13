<?php


namespace App\Services\Portal;


use App\Repositories\Portal\RepresentacaoConselhoRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RepresentacaoConselhoService
{
    private $repo;

    public function __construct(RepresentacaoConselhoRepositoryInterface $repo)
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

    public function getRepresetacaoPorConselhoAndUsuario($id_osc, $id_usuario)
    {
        return $this->repo->getRepresetacaoPorConselhoAndUsuario($id_osc, $id_usuario);
    }

    public function store(array $data)
    {
        $data['id_usuario'] = Auth::user()->id_usuario;
        return $this->repo->store($data);
    }

    public function delete($id_osc)
    {
        $id_usuario = Auth::user()->id_usuario;
        $representacao = $this->repo->getRepresetacaoPorConselhoAndUsuario($id_osc, $id_usuario);
        //Log::info($representacao);
        return $this->repo->destroy($representacao->id_representacao);
    }
}
