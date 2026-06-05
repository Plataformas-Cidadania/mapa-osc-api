<?php

namespace App\Http\Controllers;

use App\Services\AuditService;
use App\Models\Osc\Governanca;
use App\Services\Osc\GovernancaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GovernancaController extends Controller
{
    private $auditService;

    private $service;

    /**
     * Create a new controller instance.
     *
     * @param GovernancaService $service
     */
    public function __construct(GovernancaService $_service)
    {
        $this->service = $_service;
        $this->auditService = new AuditService();
    }

    public function get($id)
    {
        try {
            $governanca = $this->service->get($id);
            if (is_null($governanca))
            {
                return response()->json(['Resposta' => 'Governança não encontrada!'], Response::HTTP_OK);
            }

            return $governanca;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getGovernancaPorOSC($id_osc)
    {
        try {
            $governancas = $this->service->getGovernancaPorOSC($id_osc);

            if (count($governancas) == 0)
            {
                return response()->json(['Resposta' => 'Nenhuma Governança foi encontrada para essa OSC!'], Response::HTTP_OK);
            }

            return $governancas;
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
            $this->auditService->auditar('novoGovernanca', 'Governanca', $entidade->id_dirigente, $usuario->id_usuario, 'criado', $entidade, $request->ip(), $entidade->id_osc);

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

            $entidade = $this->service->update($id, $dados);

            if (!$entidade)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            $usuario = Auth::user();
            $this->auditService->auditar('updateGovernanca', 'Governanca', $id, $usuario->id_usuario, $dados_old, $dados, $request->ip(), $dados_old->id_osc);

            return response()->json($dados, Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_governanca, Request $request) {
        try {
            $dados_old = $this->service->get($id_governanca);

            if (!$dados_old)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            if ($this->service->delete($id_governanca))
            {
                $usuario = Auth::user();
                $this->auditService->auditar('deleteGovernanca', 'Governanca', $id_governanca, $usuario->id_usuario, $dados_old, 'deletado', $request->ip(), $dados_old->id_osc);

                return response()->json(['Resposta' => 'Governanca deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
