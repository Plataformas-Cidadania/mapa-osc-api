<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCConferencia;
use App\Services\Syst\DCConferenciaService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCConferenciaController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCConferenciaService $service
     */
    public function __construct(DCConferenciaService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/ps_conferencias",
     *     operationId="getAll",
     *     tags={"Conferência"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todas as conferência.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCConferencia")
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
     *     path="/api/ps_conferencias/{id_ps_conferencias}",
     *     operationId="get",
     *     tags={"Conferência"},
     *     @OA\Parameter(
     *       name="id_ps_conferencias",
     *       in="path",
     *       required=true,
     *       description="Número de identificação da conferência.",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados da conferência de acordo com o número de identificação informado.",
     *         @OA\JsonContent(ref="#/components/schemas/DCConferencia")
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
