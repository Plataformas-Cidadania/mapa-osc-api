<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCSituacaoImovel;
use App\Services\Syst\DCSituacaoImovelService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCSituacaoImovelController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCSituacaoImovelService $service
     */
    public function __construct(DCSituacaoImovelService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/situacao_imovel",
     *     operationId="getAll",
     *     tags={"Situacao imovel"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todas as situações do imovel.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCSituacaoImovel")
     *         )
     *     )
     * )
     */ 
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
     *     path="/api/situacao_imovel/{id_situacao_imovel}",
     *     operationId="get",
     *     tags={"Situacao imovel"},
     *     @OA\Parameter(
     *       name="id_situacao_imovel",
     *       in="path",
     *       required=true,
     *       description="Número de identificação da situação do imovel",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados da situação do imovel de acordo com o número de identificação informado.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCSituacaoImovel")
     *         )
     *     )
     * )
     */
    public function get($id)
    {
        try {
            return response()->json($this->service->get($id), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($id, Request $request) {

    }

    public function store(Request $request) {

    }

    public function delete($id) {

    }
}
