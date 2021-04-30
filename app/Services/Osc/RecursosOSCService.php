<?php


namespace App\Services\Osc;

use App\Repositories\Osc\RecursosOSCRepositoryInterface;

class RecursosOSCService
{
    private $repo;

    public function __construct(RecursosOSCRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getRecursosPorOSC($id_osc)
    {
        return $this->repo->getRecursosPorOSC($id_osc);
    }
    public function getNRecursosPorOSC($id_osc)
    {
        return $this->repo->getNRecursosPorOSC($id_osc);
    }

    public function getAnoRecursosPorOSC($id_osc)
    {
        return $this->repo->getAnoRecursosPorOSC($id_osc);
    }

    public function store(array $data)
    {
        return $this->repo->store($data);
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}