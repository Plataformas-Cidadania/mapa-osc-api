<?php

namespace App\Http\Controllers;

use App\Models\Osc\Recurso;
use App\Services\AuditService;
use App\Services\Osc\RecursosOSCService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RecursosOSCController extends Controller
{
    private $auditService;

    private $service;

    /**
     * Create a new controller instance.
     *
     * @param RecursosOSCService $service
     */
    public function __construct(RecursosOSCService $_service)
    {
        $this->service = $_service;
        $this->auditService = new AuditService();
    }

    public function getRecursosPorOSC($id_osc,  $ano)
    {
        try {
            return response()->json($this->service->getRecursosPorOSC($id_osc,  $ano), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function getNRecursosPorOSC($id_osc)
    {
        try {
            return response()->json($this->service->getNRecursosPorOSC($id_osc), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    //cd_fonte_recurso_osc + ano formatado (yyyy)
    public function getAnoRecursosPorOSC($id_osc)
    {
        try {
            return response()->json($this->service->getAnoRecursosPorOSC($id_osc), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request)
    {
        try {
            $dados = $request->all();

            $entidade = $this->service->store($dados);

            if (!$entidade)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            $usuario = Auth::user();
            $this->auditService->auditar('novoRecurso', 'Recurso', $entidade->id_recursos_osc, $usuario->id_usuario, 'criado', $entidade, $request->ip(), $entidade->id_osc);

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

            $dados_old = $this->service->getById($id);

            $entidade = $this->service->update($id, $dados);

            if (!$entidade)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            $usuario = Auth::user();
            $this->auditService->auditar('updateRecurso', 'Recurso', $id, $usuario->id_usuario, $dados_old, $dados, $request->ip(), $dados_old->id_osc);

            return response()->json(['Resposta' => 'Recurso atualizado com sucesso!'], Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function delete($id_recurso, Request $request) {
        try {

            $dados_old = $this->service->getById($id_recurso);

            if (!$dados_old)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            if ($this->service->delete($id_recurso))
            {
                $usuario = Auth::user();
                $this->auditService->auditar('deleteRecurso', 'Recurso', $id_recurso, $usuario->id_usuario, $dados_old, 'deletado', $request->ip(), $dados_old->id_osc);

                return response()->json(['Resposta' => 'Recurso deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
