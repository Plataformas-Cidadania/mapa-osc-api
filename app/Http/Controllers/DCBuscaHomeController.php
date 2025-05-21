<?php

namespace App\Http\Controllers;

use App\Services\Spat\DCBuscaHomeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Response;

class DCBuscaHomeController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCBuscaHomeService $service
     */
    public function __construct(DCBuscaHomeService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/busca/municipio/{texto_busca}",
     *     operationId="getListaMunicipios",
     *     tags={"Busca"},
     *     @OA\Parameter(
     *       name="texto_busca",
     *       in="path",
     *       required=true,
     *       description="Texto que irá procurar nos municípios.",
     *       @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos os municípios de acordo com o texto.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/ListaMunicipio")
     *         )
     *     )
     * )
     */
    public function getListaMunicipios($texto_busca)
    {
        try {
            return response()->json($this->service->getListaMunicipios($texto_busca), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/busca/estado/{texto_busca}",
     *     operationId="getListaEstados",
     *     tags={"Busca"},
     *     @OA\Parameter(
     *       name="texto_busca",
     *       in="path",
     *       required=true,
     *       description="Texto que irá procurar nos estados.",
     *       @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos os estados de acordo com o texto.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/ListaEstado")
     *         )
     *     )
     * )
     */
    public function getListaEstados($texto_busca)
    {
        try {
            return response()->json($this->service->getListaEstados($texto_busca), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/busca/regiao/{texto_busca}",
     *     operationId="getListaRegioes",
     *     tags={"Busca"},
     *     @OA\Parameter(
     *       name="texto_busca",
     *       in="path",
     *       required=true,
     *       description="Texto que irá procurar nas regiões.",
     *       @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todas as regiões de acordo com o texto.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/ListaRegiao")
     *         )
     *     )
     * )
     */
    public function getListaRegioes($texto_busca)
    {
        try {
            return response()->json($this->service->getListaRegioes($texto_busca), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/busca/todas_localizacoes/{texto_busca}",
     *     operationId="getListaTodasLocalizacoes",
     *     tags={"Busca"},
     *     @OA\Parameter(
     *       name="texto_busca",
     *       in="path",
     *       required=true,
     *       description="Texto que irá procurar as localizações.",
     *       @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todas as localizações de acordo com o texto.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/ListaLocalizacao")
     *         )
     *     )
     * )
     */
    public function getListaTodasLocalizacoes($texto_busca)
    {
        try {
            return response()->json($this->service->getListaTodasLocalizacoes($texto_busca), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
