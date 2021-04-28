<?php


namespace App\Services\Osc;

use App\Repositories\Osc\AreaAtuacaoRepresentanteRepositoryInterface;

class AreaAtuacaoRepresentanteService
{
    private $repo;

    public function __construct(AreaAtuacaoRepresentanteRepositoryInterface $_repo)
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

    public function getFormatado($id)
    {
        return $this->repo->getFormatado($id);
    }

    public function getAreasAtuacaoRepPorOSC($id_osc)
    {
        return $this->repo->getAreasAtuacaoRepPorOSC($id_osc);
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