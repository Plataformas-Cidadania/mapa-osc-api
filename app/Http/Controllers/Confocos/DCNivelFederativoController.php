<?php

namespace App\Http\Controllers\Confocos;

use App\Http\Controllers\Controller;
use App\Services\Confocos\DCNivelFederativoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCNivelFederativoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCNivelFederativoService $service
     */
    public function __construct(DCNivelFederativoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/confocos/nivel_federativo",
     *     operationId="getAll",
     *     tags={"Nivel Federativo"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos os Niveis Federativos.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCNivelFederativo")
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
     *     path="/api/confocos/nivel_federativo/{id_nivel_federativo}",
     *     operationId="get",
     *     tags={"Tipo participação"},
     *     @OA\Parameter(
     *       name="id_nivel_federativo",
     *       in="path",
     *       required=true,
     *       description="Número de identificação do Nivel Federativo.",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados do nivel federativo de acordo com o número de identificação informado.",
     *         @OA\JsonContent(ref="#/components/schemas/DCNivelFederativo")
     *     )
     * )
     */
    public function get($id_nivel_federativo)
    {
        try {
            return response()->json($this->service->get($id_nivel_federativo), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($id_nivel_federativo, Request $request) {
        try {
            $dados = $request->all();

            $nivel_federativo = $this->service->update($id_nivel_federativo, $dados);

            if ($nivel_federativo) {
                return response()->json(['Resposta' => 'Nivel Federativo atualizado com sucesso!'], Response::HTTP_OK);
            }
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

    public function delete($id) {
        try {
            $resposta = $this->service->delete($id);

            if ($resposta) {
                return response()->json(['Resposta' => 'Nível Federativo deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
