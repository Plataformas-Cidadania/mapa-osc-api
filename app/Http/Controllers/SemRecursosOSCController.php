<?php

namespace App\Http\Controllers;

use App\Models\Osc\SemRecurso;
use App\Services\AuditService;
use App\Services\Osc\SemRecursosOSCService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SemRecursosOSCController extends Controller
{
    private $auditService;
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param SemRecursosOSCService $service
     */
    public function __construct(SemRecursosOSCService $_service)
    {
        $this->service = $_service;
        $this->auditService = new AuditService();
    }

    public function getAnosSemRecursosPorOSC($id_osc, $ano)
    {
        try {
            return response()->json($this->service->getAnosSemRecursosPorOSC($id_osc, $ano), Response::HTTP_OK);
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
            $this->auditService->auditar('marcarAnoSemRecurso', 'AnoSemRecurso', $entidade->ano, $usuario->id_usuario, 'criado', $entidade, $request->ip(), $entidade->id_osc);

            return response()->json($entidade, Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_osc, $ano, $origem, Request $request) {
        try {

            $dados_old = $this->service->getByOscAndAnoAndOrigem($id_osc, $ano, $origem);

            if (!$dados_old)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            if ($this->service->delete($id_osc, $ano, $origem))
            {
                $usuario = Auth::user();
                $this->auditService->auditar('deleteAnoSemRecurso', 'AnoSemRecurso', $ano, $usuario->id_usuario, $dados_old, 'deletado', $request->ip(), $dados_old->id_osc);

                return response()->json(['Resposta' => 'Recurso deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
