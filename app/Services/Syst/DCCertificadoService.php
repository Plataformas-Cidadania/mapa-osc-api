<?php


namespace App\Services\Syst;

use App\Repositories\Syst\DCCertificadoRepositoryInterface;

class DCCertificadoService
{
    private $repo;

    public function __construct(DCCertificadoRepositoryInterface $_repo)
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