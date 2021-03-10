<?php


namespace App\Services\Osc;

use App\Repositories\Osc\ObjetivoOscRepositoryInterface;

class ObjetivoOscService
{
    private $repo;

    public function __construct(ObjetivoOscRepositoryInterface $_repo)
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

    public function getObjetivosPorOsc($id_osc)
    {
        return $this->repo->getObjetivosPorOsc($id_osc);
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