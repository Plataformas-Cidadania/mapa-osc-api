<?php


namespace App\Services\Osc;

use App\Repositories\Osc\QuadroSocietarioRepositoryInterface;

class QuadroSocietarioService
{
    private $repo;

    public function __construct(QuadroSocietarioRepositoryInterface $_repo)
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

    public function getQuadroSocietarioPorOSC($id_osc)
    {
        return $this->repo->getQuadroSocietarioPorOSC($id_osc);
    }

    public function store(array $data)
    {
        return $this->repo->store($data);
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete($id_quadro_societario)
    {
        return $this->repo->delete($id_quadro_societario);
    }
}