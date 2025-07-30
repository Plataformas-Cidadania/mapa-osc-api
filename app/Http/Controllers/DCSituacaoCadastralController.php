<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCSituacaoCadastral;
use App\Services\Syst\DCSituacaoCadastralService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCSituacaoCadastralController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCSituacaoCadastralService $service
     */
    public function __construct(DCSituacaoCadastralService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/situacao_cadastral",
     *     operationId="getAll",
     *     tags={"Situação cadastral"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todas as situações cadastrais.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCSituacaoCadastral")
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
     *     path="/api/situacao_cadastral/{id_situacao_cadastral}",
     *     operationId="get",
     *     tags={"Situação cadastral"},
     *     @OA\Parameter(
     *       name="id_situacao_cadastral",
     *       in="path",
     *       required=true,
     *       description="Número de identificação da sitação cadastral.",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados da situação cadastral de acordo com o número de identificação informado.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCSituacaoCadastral")
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
        try {
            $dados = $request->all();

            return response()->json($this->service->update($id, $dados), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request) {

    }

    public function delete($id) {

    }
}
