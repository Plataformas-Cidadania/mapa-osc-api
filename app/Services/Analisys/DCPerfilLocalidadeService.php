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
}
