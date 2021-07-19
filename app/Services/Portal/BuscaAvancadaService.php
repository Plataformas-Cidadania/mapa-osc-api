<?php


namespace App\Services\Portal;


use App\Repositories\Portal\BuscaAvancadaRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BuscaAvancadaService
{
    private $repo;

    public function __construct(BuscaAvancadaRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function buscarOSCs($type_result, $param = null, $busca)
    {
        return $this->repo->buscarOSCs($type_result, $param, $busca);
    }

    public function exportarOSCs($lista_oscs, $lista_indices)
    {
        return $this->repo->exportarOSCs($lista_oscs, $lista_indices);
    }
}
