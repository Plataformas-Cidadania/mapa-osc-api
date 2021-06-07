<?php

namespace App\Http\Controllers;

use App\Services\Osc\DCListaOSCsRegiaoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Response;

class DCListaOSCsRegiaoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCListaOSCsRegiaoService $service
     */
    public function __construct(DCListaOSCsRegiaoService $_service)
    {
        $this->service = $_service;
    }

    public function getListaOSCsMunicipio($idlocalidade)
    {
        try {
            return response()->json($this->service->getListaOSCsMunicipio($idlocalidade), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaOSCsEstado($idlocalidade)
    {
        try {
            return response()->json($this->service->getListaOSCsEstado($idlocalidade), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaOSCsRegiao($idlocalidade)
    {
        try {
            return response()->json($this->service->getListaOSCsRegiao($idlocalidade), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
