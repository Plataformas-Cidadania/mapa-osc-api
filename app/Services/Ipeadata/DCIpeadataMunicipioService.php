<?php


namespace App\Services\Ipeadata;

use App\Repositories\Ipeadata\DCIpeadataMunicipioRepositoryInterface;

class DCIpeadataMunicipioService
{

    private $repo;

    public function __construct(DCIpeadataMunicipioRepositoryInterface $_repo)
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
}