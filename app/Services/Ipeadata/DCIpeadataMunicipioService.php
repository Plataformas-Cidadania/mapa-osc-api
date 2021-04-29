<?php


namespace App\Services\Ipeadata;

use App\Repositories\Ipeadata\DCIpeadataUffRepositoryInterface;

class DCIpeadataService
{

    private $repo;

    public function __construct(DCIpeadataUffRepositoryInterface $_repo)
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