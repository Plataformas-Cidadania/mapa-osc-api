<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCAbrangenciaProjeto;
use App\Services\Syst\DCAbrangenciaProjetoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCAbrangenciaProjetoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCAbrangenciaProjetoService $service
     */
    public function __construct(DCAbrangenciaProjetoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/abrangencia_projeto",
     *     operationId="getAll",
     *     tags={"Abrangência projeto"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos as abrangências do projeto.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCAbrangenciaProjeto")
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
     *     path="/api/abrangencia_projeto/{id_abrangencia_projeto}",
     *     operationId="get",
     *     tags={"Abrangência projeto"},
     *     @OA\Parameter(
     *       name="id_abrangencia_projeto",
     *       in="path",
     *       required=true,
     *       description="Número de identificação da abrangência do projeto.",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados da abrangência do projeto de acordo com o número de identificação informado.",
     *         @OA\JsonContent(ref="#/components/schemas/DCAbrangenciaProjeto")         
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
