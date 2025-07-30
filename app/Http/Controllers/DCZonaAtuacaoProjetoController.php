<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCZonaAtuacaoProjeto;
use App\Services\Syst\DCZonaAtuacaoProjetoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCZonaAtuacaoProjetoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCZonaAtuacaoProjetoService $service
     */
    public function __construct(DCZonaAtuacaoProjetoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/zona_atuacao_projeto",
     *     operationId="getAll",
     *     tags={"Atuação projeto"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos as atuações do projeto.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCZonaAtuacaoProjeto")
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
     *     path="/api/zona_atuacao_projeto/{id_zona_atuacao_projeto}",
     *     operationId="get",
     *     tags={"Atuação projeto"},
     *     @OA\Parameter(
     *       name="id_abrangencia_projeto",
     *       in="path",
     *       required=true,
     *       description="Número de identificação da atuação do projeto.",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados da atuação do projeto de acordo com o número de identificação informado.",
     *         @OA\JsonContent(ref="#/components/schemas/DCZonaAtuacaoProjeto")
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
