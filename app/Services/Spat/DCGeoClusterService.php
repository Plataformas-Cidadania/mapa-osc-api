<?php


namespace App\Services\Spat;

use App\Repositories\Spat\DCGeoClusterRepositoryInterface;

class DCGeoClusterService
{

    private $repo;

    public function __construct(DCGeoClusterRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getMunicipiosPorEstado($id_estado)
    {
        return $this->repo->getMunicipiosPorEstado($id_estado);
    }

    public function getEstadosPorRegiao($id_regiao)
    {
        return $this->repo->getEstadosPorRegiao($id_regiao);
    }

    public function getOSCsPorEstado($id_regiao)
    {
        return $this->repo->getOSCsPorEstado($id_regiao);
    }

    public function get($id)
    {
        return $this->repo->get($id);
    }

    public function getRegiaoAll()
    {
        return $this->repo->getRegiaoAll();
    }

    public function getEstadoAll()
    {
        return $this->repo->getEstadoAll();
    }
}