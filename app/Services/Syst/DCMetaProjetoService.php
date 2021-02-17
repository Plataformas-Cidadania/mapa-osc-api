<?php


namespace App\Services\Syst;

use App\Repositories\Syst\DCMetaProjetoRepositoryInterface;

class DCMetaProjetoService
{
    private $repo;

    public function __construct(DCMetaProjetoRepositoryInterface $_repo)
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

    public function getMetasPorObjetivo($id_objetivo)
    {
        return $this->repo->getMetasPorObjetivo($id_objetivo);
    }

    public function store(array $data)
    {
        // TODO: Implement store() method.
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        // TODO: Implement destroy() method.
    }
}