<?php


namespace App\Services\Portal;

use App\Repositories\Portal\AssinaturaTermoRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AssinaturaTermosService
{
    private $repo;

    public function __construct(AssinaturaTermoRepositoryInterface $repo)
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

    public function getPorRepresentacaoAndTermo($id_representacao, $id_termo)
    {
        return $this->repo->getPorRepresentacaoAndTermo($id_representacao, $id_termo);
    }

    public function getAllPorRepresentacao($id_representacao)
    {
        return $this->repo->getAllPorRepresentacao($id_representacao);
    }

    public function store(array $data)
    {
        return $this->repo->store($data);
    }

    public function delete($id_representacao, $id_termo)
    {
        $assinatura = $this->repo->getPorRepresentacaoAndTermo($id_representacao, $id_termo);
        //Log::info($representacao);
        return $this->repo->destroy($assinatura->id_assinatura);
    }
}