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

    public function getListaOSCsMunicipio($id_localidade, $pagina)
    {
        return $this->repo->getListaOSCsMunicipio($id_localidade, $pagina);
    }

    public function getListaOSCsEstado($id_localidade, $pagina)
    {
        return $this->repo->getListaOSCsEstado($id_localidade, $pagina);
    }

    public function getListaOSCsRegiao($id_localidade, $pagina)
    {
        return $this->repo->getListaOSCsRegiao($id_localidade, $pagina);
    }
}