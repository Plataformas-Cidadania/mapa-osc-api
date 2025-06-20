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

    /**
     * @OA\Get(
     *     path="/api/geo/municipios/estado/{id_estado}",
     *     operationId="getMunicipiosPorEstado",
     *     tags={"Geo"},
     *     @OA\Parameter(
     *       name="id_estado",
     *       in="path",
     *       required=true,
     *       description="Número de identificação do estado",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna os municípios de acordo com o estado informado.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCGeoCluster")
     *         )
     *     )
     * )
     */
    public function getMunicipiosPorEstado($id_estado)
    {
        try {
            return response()->json($this->service->getMunicipiosPorEstado($id_estado), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/geo/estados/regiao/{id_regiao}",
     *     operationId="getEstadosPorRegiao",
     *     tags={"Geo"},
     *     @OA\Parameter(
     *       name="id_regiao",
     *       in="path",
     *       required=true,
     *       description="Número de identificação da região",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna os estados de acordo com a região informado.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCGeoCluster")
     *         )
     *     )
     * )
     */
    public function getEstadosPorRegiao($id_regiao)
    {
        try {
            return response()->json($this->service->getEstadosPorRegiao($id_regiao), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/geo/oscs/estado/{id_estado}",
     *     operationId="getOSCsPorEstado",
     *     tags={"Geo"},
     *     @OA\Parameter(
     *       name="id_estado",
     *       in="path",
     *       required=true,
     *       description="Número de identificação do estado",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todas OSCs de acordo com o estado informado.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/OSCsPorEstado")
     *         )
     *     )
     * )
     */
    public function getOSCsPorEstado($id_regiao)
    {
        try {
            return response()->json($this->service->getOSCsPorEstado($id_regiao), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/geo/oscs/municipio/{id_municipio}",
     *     operationId="getOSCsPorMunicipio",
     *     tags={"Geo"},
     *     @OA\Parameter(
     *       name="id_municipio",
     *       in="path",
     *       required=true,
     *       description="Número de identificação do municipio",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todas OSCs de acordo com o municipio informado.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/OSCsPorEstado")
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/geo/regioes",
     *     operationId="getRegiaoAll",
     *     tags={"Geo"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todas as regiões.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCGeoCluster")
     *         )
     *     )
     * )
     */
    public function getRegiaoAll()
    {
        try {
            return response()->json($this->service->getRegiaoAll(), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/geo/estados",
     *     operationId="getEstadoAll",
     *     tags={"Geo"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos os estados.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCGeoCluster")
     *         )
     *     )
     * )
     */

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
