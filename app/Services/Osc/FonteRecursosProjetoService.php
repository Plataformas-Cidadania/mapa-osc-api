<?php


namespace App\Services\Osc;

use App\Repositories\Osc\FonteRecursosProjetoRepositoryInterface;

class FonteRecursosProjetoService
{
    private $repo;

    public function __construct(FonteRecursosProjetoRepositoryInterface $_repo)
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

    public function getFonteRecursosPorProjeto($id_projeto)
    {
        return $this->repo->getFonteRecursosPorProjeto($id_projeto);
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