<?php

namespace App\Http\Controllers;

use App\Services\Analisys\DCPerfilLocalidadeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Response;

class DCPerfilLocalidadeController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCPerfilLocalidadeService $service
     */
    public function __construct(DCPerfilLocalidadeService $_service)
    {
        $this->service = $_service;
    }

    public function getEvolucaoQtdOscPorAno($idlocalidade)
    {
        try {
            return response()->json($this->service->getEvolucaoQtdOscPorAno($idlocalidade), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getCaracteristicas($idlocalidade)
    {
        try {
            return response()->json($this->service->getCaracteristicas($idlocalidade), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getQtdNaturezaJuridica($idlocalidade)
    {
        try {
            return response()->json($this->service->getQtdNaturezaJuridica($idlocalidade), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getTransferenciasFederais($idlocalidade)
    {
        try {
            return response()->json($this->service->getTransferenciasFederais($idlocalidade), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getQtdOscPorAreasAtuacao($idlocalidade)
    {
        try {
            return response()->json($this->service->getQtdOscPorAreasAtuacao($idlocalidade), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
