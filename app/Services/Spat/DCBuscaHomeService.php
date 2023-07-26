<?php


namespace App\Services\Spat;

use App\Repositories\Spat\DCBuscaHomeRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DCBuscaHomeService
{
    private $repo;

    public function __construct(DCBuscaHomeRepositoryInterface $_repo)
    {
        $this->repo = $_repo;
    }

    public function getListaMunicipios($texto_busca)
    {
        return $this->repo->getListaMunicipios($texto_busca);
    }
    public function getListaEstados($texto_busca)
    {
        return $this->repo->getListaEstados($texto_busca);
    }
    public function getListaRegioes($texto_busca)
    {
        return $this->repo->getListaRegioes($texto_busca);
    }

    public function getListaTodasLocalizacoes($texto_busca)
    {
        return $this->repo->getListaTodasLocalizacoes($texto_busca);
    }
}
