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