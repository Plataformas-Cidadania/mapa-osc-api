<?php

namespace App\Http\Controllers;

use App\Models\Osc\OscParceiraProjeto;
use App\Services\Osc\OscParceiraProjetoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OscParceiraProjetoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param OscParceiraProjetoService $service
     */
    public function __construct(OscParceiraProjetoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/osc/projeto/parceira/{id}",
     *     operationId="get",
     *     tags={"Projeto"},
     *     @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="Número de identificação da parceira",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna os dados da parceria do projeto de acordo com identificação da parceira informado.",
     *         @OA\JsonContent(ref="#/components/schemas/OscParceiraProjeto")
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

    /**
     * @OA\Get(
     *     path="/api/osc/projeto/parceiras/{id_projeto}",
     *     operationId="getParceriasPorProjeto",
     *     tags={"Projeto"},
     *     @OA\Parameter(
     *       name="id_projeto",
     *       in="path",
     *       required=true,
     *       description="Número de identificação do projeto",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todas as parcerias dos projetos de acordo com o projeto informado.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/OSCsPorEstado")
     *         )
     *     )
     * )
     */
    public function getParceriasPorProjeto($id_projeto)
    {
        try {
            return response()->json($this->service->getParceriasPorProjeto($id_projeto), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request) {
        try {
            $dados = $request->all();

            //Retorna novo registro
            return response()->json($this->service->store($dados), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($id, Request $request) {
        try {
            $dados = $request->all();

            $parceira = $this->service->update($id, $dados);

            if ($parceira) {

                return response()->json(['Resposta' => 'Parceria de Projeto atualizada com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_parceira) {
        try {
            if ($this->service->destroy($id_parceira))
            {
                return response()->json(['Resposta' => 'Parceria de Projeto deletada com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
