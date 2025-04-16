<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCStatusProjeto;
use App\Services\Syst\DCStatusProjetoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCStatusProjetoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCStatusProjetoService $service
     */
    public function __construct(DCStatusProjetoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/status_projeto",
     *     operationId="getAll",
     *     tags={"Status projeto"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos os status do projeto.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCStatusProjeto")
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
     *     path="/api/status_projeto/{id_status_projeto}",
     *     operationId="get",
     *     tags={"Status projeto"},
     *     @OA\Parameter(
     *       name="id_certificado",
     *       in="path",
     *       required=true,
     *       description="Número de identificação do status projeto",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados status do projeto de acordo com o número de identificação informado.",
     *         @OA\JsonContent(ref="#/components/schemas/DCStatusProjeto")
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
