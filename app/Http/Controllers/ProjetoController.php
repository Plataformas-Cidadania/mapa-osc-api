<?php

namespace App\Http\Controllers;

use App\Models\Osc\Projeto;
use App\Services\AuditService;
use App\Services\Osc\ProjetoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ProjetoController extends Controller
{
    private $auditService;

    private $service;

    /**
     * Create a new controller instance.
     *
     * @param ProjetoService $service
     */
    public function __construct(ProjetoService $_service)
    {
        $this->service = $_service;
        $this->auditService = new AuditService();
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

            $entidade = $this->service->store($dados);

            if (!$entidade)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            $usuario = Auth::user();
            $this->auditService->auditar('novoProjeto', 'Projeto', $entidade->id_projeto, $usuario->id_usuario, 'criado', $entidade, $request->ip(), $entidade->id_osc);

            //Retorna novo registro
            return response()->json($entidade, Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($id, Request $request) {
        try {

            $dados = $request->all();

            $dados_old = $this->service->get($id);

            $projeto = $this->service->update($id, $dados);

            if (!$projeto)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            $usuario = Auth::user();
            $this->auditService->auditar('updateProjeto', 'Projeto', $id, $usuario->id_usuario, $dados_old, $dados, $request->ip(), $dados_old->id_osc);

            return response()->json(['Resposta' => 'Projeto atualizado com sucesso!'], Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_projeto, Request $request) {
        try {

            $dados_old = $this->service->get($id_projeto);

            if (!$dados_old)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            if ($this->service->destroy($id_projeto))
            {
                $usuario = Auth::user();
                $this->auditService->auditar('deleteProjeto', 'Projeto', $id_projeto, $usuario->id_usuario, $dados_old, 'deletado', $request->ip(), $dados_old->id_osc);

                return response()->json(['Resposta' => 'Projeto deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
