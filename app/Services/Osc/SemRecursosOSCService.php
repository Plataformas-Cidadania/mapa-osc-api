<?php


namespace App\Services\Osc;

use App\Repositories\Osc\SemRecursosOSCRepositoryInterface;

class SemRecursosOSCService
{
    private $repo;

    public function __construct(SemRecursosOSCRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAnosSemRecursosPorOSC($id_osc)
    {
        return $this->repo->getAnosSemRecursosPorOSC($id_osc);
    }
  
    public function store(array $data)
    {
        return $this->repo->store($data);
    }

    public function delete($id, array $oscAnoOrigem)
    {
        return $this->repo->delete($id, $oscAnoOrigem);
    }
}