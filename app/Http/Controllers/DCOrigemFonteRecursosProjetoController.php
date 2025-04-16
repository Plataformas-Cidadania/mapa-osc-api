<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCOrigemFonteRecursosProjeto;
use App\Services\Syst\DCOrigemFonteRecursosProjetoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCOrigemFonteRecursosProjetoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCOrigemFonteRecursosProjetoService $service
     */
    public function __construct(DCOrigemFonteRecursosProjetoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/origem_fonte_recurso_projeto",
     *     operationId="getAll",
     *     tags={"Fonte de recursos do projeto"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos as fontes de recursos do projeto.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCOrigemFonteRecursosProjeto")
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
     *     path="/api/origem_fonte_recurso_projeto/{id_origem_fonte_recurso_projeto}",
     *     operationId="get",
     *     tags={"Fonte de recursos do projeto"},
     *     @OA\Parameter(
     *       name="id_origem_fonte_recurso_projeto",
     *       in="path",
     *       required=true,
     *       description="Número de identificação da fonte de recursos do projeto.",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados da fonte de recursos do projeto de acordo com o número de identificação informado.",
     *         @OA\JsonContent(ref="#/components/schemas/DCOrigemFonteRecursosProjeto")
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
