<?php

namespace App\Http\Controllers;

use App\Services\AuditService;
use App\Models\Osc\ConselhoFiscal;
use App\Services\Osc\ConselhoFiscalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ConselhoFiscalController extends Controller
{
    private $auditService;

    private $service;

    /**
     * Create a new controller instance.
     *
     * @param ConselhoFiscal $service
     */
    public function __construct(ConselhoFiscalService $_service)
    {
        $this->service = $_service;
        $this->auditService = new AuditService();
    }

    public function get($id)
    {
        try {
            $conselho = $this->service->get($id);
            if (is_null($conselho))
            {
                return response()->json(['Resposta' => 'Item do Conselho Fiscal não encontrado!'], Response::HTTP_OK);
            }

            return $conselho;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getConselhoFiscalPorOSC($id_osc)
    {
        try {
            $conselhos = $this->service->getConselhoFiscalPorOSC($id_osc);

            if (count($conselhos) == 0)
            {
                return response()->json(['Resposta' => 'Nenhum Conselho Fiscal foi encontrado para essa OSC!'], Response::HTTP_OK);
            }

            return $conselhos;
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
            $this->auditService->auditar('novoConselho', 'Conselho', $entidade->id_conselheiro, $usuario->id_usuario, 'criado', $entidade, $request->ip(), $entidade->id_osc);

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
            $this->auditService->auditar('updateConselho', 'Conselho', $id, $usuario->id_usuario, $dados_old, $dados, $request->ip(), $dados_old->id_osc);

            return response()->json($dados, Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_conselho, Request $request) {
        try {
            $dados_old = $this->service->get($id_conselho);

            if ($this->service->delete($id_conselho))
            {
                $usuario = Auth::user();
                $this->auditService->auditar('deleteConselho', 'Conselho', $id_conselho, $usuario->id_usuario, $dados_old, 'deletado', $request->ip(), $dados_old->id_osc);

                return response()->json(['Resposta' => 'Conselho Fiscal deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
