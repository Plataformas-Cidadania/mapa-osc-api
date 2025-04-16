<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCTipoParticipacao;
use App\Services\Syst\DCTipoParticipacaoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCTipoParticipacaoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCTipoParticipacaoService $service
     */
    public function __construct(DCTipoParticipacaoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/tipo_participacao",
     *     operationId="getAll",
     *     tags={"Tipo participação"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos os tipo de participação.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCTipoParticipacao")
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
     *     path="/api/tipo_participacao/{id_tipo_participacao}",
     *     operationId="get",
     *     tags={"Tipo participação"},
     *     @OA\Parameter(
     *       name="id_tipo_participacao",
     *       in="path",
     *       required=true,
     *       description="Número de identificação do tipo participação.",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados do tipo participação de acordo com o número de identificação informado.",
     *         @OA\JsonContent(ref="#/components/schemas/DCTipoParticipacao")
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
