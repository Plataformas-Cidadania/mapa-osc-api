<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCFormaParticipacaoConferencia;
use App\Services\Syst\DCFormaParticipacaoConferenciaService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCFormaParticipacaoConferenciaController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCFormaParticipacaoConferenciaService $service
     */
    public function __construct(DCFormaParticipacaoConferenciaService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/ps_conferencias_formas",
     *     operationId="getAll",
     *     tags={"Conferência"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todas as formas de participação da conferência.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCFormaParticipacaoConferencia")
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
     *     path="/api/ps_conferencia_forma/{id_ps_conferencia_forma}",
     *     operationId="get",
     *     tags={"Conferência"},
     *     @OA\Parameter(
     *       name="id_ps_conferencia_forma",
     *       in="path",
     *       required=true,
     *       description="Número de identificação da forma de participação da conferência.",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados da forma de participação da conferência de acordo com o número de identificação informado.",
     *         @OA\JsonContent(ref="#/components/schemas/DCFormaParticipacaoConferencia")
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
