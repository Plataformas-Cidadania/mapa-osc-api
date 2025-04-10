<?php

namespace App\Http\Controllers;

use App\Services\Portal\AssinaturaTermosService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AssinaturaTermoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param AssinaturaTermosService $service
     */
    public function __construct(AssinaturaTermosService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/osc/assinatura-termos",
     *     operationId="getAll",
     *     tags={"Assinaturas de Termo"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos as Assinaturas da Base",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/AssinaturaTermo")
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
     *     path="/api/osc/assinatura-termos/{id}",
     *     operationId="get",
     *     tags={"Assinaturas de Termo"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna a Assinatura pelo Identificador",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/AssinaturaTermo")
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

    public function getPorRepresentacaoAndTermo($id_representacao, $id_termo)
    {
        try {
            return response()->json($this->service->getPorRepresentacaoAndTermo($id_representacao, $id_termo), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAllPorRepresentacao($id_representacao)
    {
        try {
            return response()->json($this->service->getAllPorRepresentacao($id_representacao), Response::HTTP_OK);
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

    public function delete(Request $request) {

        $dados = $request->all();

        try {
            return response()->json($this->service->delete($dados['$id_representacao'], $dados['$id_termo']), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
