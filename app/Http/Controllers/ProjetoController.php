<?php

namespace App\Http\Controllers;

use App\Models\Osc\Projeto;
use App\Services\Osc\ProjetoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjetoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param ProjetoService $service
     */
    public function __construct(ProjetoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/osc/projeto/{id}",
     *     operationId="get",
     *     tags={"Projeto"},
     *     @OA\Parameter(
     *       name="id",
     *       in="path",
     *       required=true,
     *       description="Número de identificação do projeto",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados do projeto",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/Projeto")
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

    public function getFormatado($id)
    {
        try {
            return response()->json($this->service->getFormatado($id), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getProjetosPorOSC($id_osc)
    {
        try {
            return response()->json($this->service->getProjetosPorOSC($id_osc), Response::HTTP_OK);
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

            $projeto = $this->service->update($id, $dados);

            if ($projeto) {

                return response()->json(['Resposta' => 'Projeto atualizado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_projeto) {
        try {
            if ($this->service->destroy($id_projeto))
            {
                return response()->json(['Resposta' => 'Projeto deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
