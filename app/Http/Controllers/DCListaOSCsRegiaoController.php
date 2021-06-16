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

    public function getListaOSCsTotal($pagina)
    {
        try {
            return response()->json($this->service->getListaOSCsTotal($pagina), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaOSCsMunicipio($id_localidade, $pagina)
    {
        try {
            return response()->json($this->service->getListaOSCsMunicipio($id_localidade, $pagina), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaOSCsEstado($id_localidade, $pagina)
    {
        try {
            return response()->json($this->service->getListaOSCsEstado($id_localidade, $pagina), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaOSCsRegiao($id_localidade, $pagina)
    {
        try {
            return response()->json($this->service->getListaOSCsRegiao($id_localidade, $pagina), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
