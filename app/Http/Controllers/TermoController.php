<?php

namespace App\Http\Controllers;

use App\Services\Portal\TermoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TermoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param TermoService $service
     */
    public function __construct(TermoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/osc/termos",
     *     operationId="getAll",
     *     tags={"Termo"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos as Termos da Base",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/Termo")
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
     *     path="/api/osc/termos/{id}",
     *     operationId="get",
     *     tags={"Termo"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna Termo pelo Identificador",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/Termo")
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
        try {
            $dados = $request->all();

            return response()->json($this->service->store($dados), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_termo) {

        try {
            return response()->json($this->service->delete($id_termo), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
