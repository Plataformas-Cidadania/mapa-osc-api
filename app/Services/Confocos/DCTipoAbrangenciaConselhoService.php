<?php


namespace App\Services\Confocos;

use App\Repositories\Confocos\DCTipoAbrangenciaConselhoRepositoryInterface;

class DCTipoAbrangenciaConselhoService
{
    private $repo;

    public function __construct(DCTipoAbrangenciaConselhoRepositoryInterface $_repo)
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
        return $this->repo->destroy($id);
    }
}