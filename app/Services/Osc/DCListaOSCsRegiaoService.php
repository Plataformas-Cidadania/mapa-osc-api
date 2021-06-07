<?php


namespace App\Services\Osc;

use App\Repositories\Osc\DCListaOSCsRegiaoRepositoryInterface;

class DCListaOSCsRegiaoService
{

    private $repo;

    public function __construct(DCListaOSCsRegiaoRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getListaOSCsMunicipio($id_localidade)
    {
        return $this->repo->getListaOSCsMunicipio($id_localidade);
    }

    public function getListaOSCsEstado($id_localidade)
    {
        return $this->repo->getListaOSCsEstado($id_localidade);
    }

    public function getListaOSCsRegiao($id_localidade)
    {
        return $this->repo->getListaOSCsRegiao($id_localidade);
    }
}