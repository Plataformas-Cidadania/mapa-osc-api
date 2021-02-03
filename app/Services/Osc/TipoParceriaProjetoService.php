<?php


namespace App\Services\Osc;

use App\Repositories\Osc\TipoParceriaProjetoRepositoryInterface;

class TipoParceriaProjetoService
{
    private $repo;

    public function __construct(TipoParceriaProjetoRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function get($id)
    {
        return $this->repo->get($id);
    }

    public function getParceriasPorProjeto($id_projeto)
    {
        return $this->repo->getParceriasPorProjeto($id_projeto);
    }

    public function store(array $data)
    {
        return $this->repo->store($data);
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->repo->destroy($id);
    }
}