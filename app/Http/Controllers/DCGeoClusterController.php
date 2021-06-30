<?php

namespace App\Http\Controllers;

use App\Services\Spat\DCGeoClusterService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCGeoClusterController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCGeoClusterService $service
     */
    public function __construct(DCGeoClusterService $_service)
    {
        $this->service = $_service;
    }

    public function getAll()
    {
        try {
            return response()->json($this->service->getAll(), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getMunicipiosPorEstado($id_estado)
    {
        try {
            return response()->json($this->service->getMunicipiosPorEstado($id_estado), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getEstadosPorRegiao($id_regiao)
    {
        try {
            return response()->json($this->service->getEstadosPorRegiao($id_regiao), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getOSCsPorEstado($id_regiao)
    {
        try {
            return response()->json($this->service->getOSCsPorEstado($id_regiao), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getOSCsPorMunicipio($id_regiao)
    {
        try {
            return response()->json($this->service->getOSCsPorMunicipio($id_regiao), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getOSCsPorRazaoSocial($tx_parametro)
    {
        try {
            return response()->json($this->service->getOSCsPorRazaoSocial($tx_parametro), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get($id)
    {
        try {
            return response()->json($this->service->get($id), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getRegiaoAll()
    {
        try {
            return response()->json($this->service->getRegiaoAll(), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getEstadoAll()
    {
        try {
            return response()->json($this->service->getEstadoAll(), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
