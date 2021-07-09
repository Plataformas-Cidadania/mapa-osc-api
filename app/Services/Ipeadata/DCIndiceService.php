<?php


namespace App\Services\Ipeadata;

use App\Repositories\Ipeadata\DCIndiceRepositoryInterface;

class DCIndiceService
{

    private $repo;

    public function __construct(DCIndiceRepositoryInterface $_repo)
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