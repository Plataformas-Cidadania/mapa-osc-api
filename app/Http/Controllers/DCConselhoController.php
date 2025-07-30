<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCConselho;
use App\Services\Syst\DCConselhoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCConselhoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCConselhoService $service
     */
    public function __construct(DCConselhoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/ps_conselhos",
     *     operationId="getAll",
     *     tags={"Participação social"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todas as participações sociais conselho.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCConselho")
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
     *     path="/api/ps_conselhos/{id_ps_conselhos}",
     *     operationId="get",
     *     tags={"Participação social"},
     *     @OA\Parameter(
     *       name="id_ps_conselhos",
     *       in="path",
     *       required=true,
     *       description="Número de identificação da participação social conselho.",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados da participação social conselho de acordo com o número de identificação informado.",
     *         @OA\JsonContent(ref="#/components/schemas/DCConselho")
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
