<?php


namespace App\Services\Analisys;

use App\Repositories\Analisys\DCPerfilLocalidadeRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DCPerfilLocalidadeService
{
    private $repo;

    public function __construct(DCPerfilLocalidadeRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getEvolucaoQtdOscPorAno($idlocalidade)
    {
        return $this->repo->getEvolucaoQtdOscPorAno($idlocalidade);
    }

    public function getCaracteristicas($idlocalidade)
    {
        return $this->repo->getCaracteristicas($idlocalidade);
    }

    public function getQtdNaturezaJuridica($idlocalidade)
    {
        return $this->repo->getQtdNaturezaJuridica($idlocalidade);
    }

    public function getTransferenciasFederais($idlocalidade)
    {
        return $this->repo->getTransferenciasFederais($idlocalidade);
    }

    public function getQtdOscPorAreasAtuacao($idlocalidade)
    {
        return $this->repo->getQtdOscPorAreasAtuacao($idlocalidade);
    }

    public function getQtdTrabalhadores($idlocalidade)
    {
        return $this->repo->getQtdTrabalhadores($idlocalidade);
    }
}
