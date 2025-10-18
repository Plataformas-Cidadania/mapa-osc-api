<?php


namespace App\Services\Confocos;

use App\Repositories\Confocos\ConselheiroRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ConselheiroService
{
    private $repo;

    public function __construct(ConselheiroRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getPorId($id)
    {
        return $this->repo->getPorId($id);
    }

    public function getListaConselheirosPorConselho($id_conselho)
    {
        return $this->repo->getListaConselheirosPorConselho($id_conselho);
    }

    public function store(array $data)
    {
        return $this->repo->store($data);
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function destroy($id_conselho)
    {
        return $this->repo->destroy($id_conselho);
    }
}
