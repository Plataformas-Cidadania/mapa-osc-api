<?php

namespace App\Http\Controllers;

use App\Services\AuditService;
use App\Services\Osc\ParticipacaoSocialConferenciaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ParticipacaoSocialConferenciaController extends Controller
{
    private $auditService;
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param ParticipacaoSocialConferenciaService $service
     */
    public function __construct(ParticipacaoSocialConferenciaService $_service)
    {
        $this->service = $_service;
        $this->auditService = new AuditService();
    }

    public function getAll()
    {
        try {
            $ps_conferencias = $this->service->getAll();
            if (is_null($ps_conferencias))
            {
                return response()->json(['Resposta' => 'Item Participação Social Conferência não encontrado!'], Response::HTTP_OK);
            }

            return $ps_conferencias;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get($id)
    {
        try {
            $ps_conferencia = $this->service->get($id);
            if (is_null($ps_conferencia))
            {
                return response()->json(['Resposta' => 'Item Participação Social Conferência não encontrado!'], Response::HTTP_OK);
            }

            return $ps_conferencia;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getParticipacaoSocialConferenciaPorOSC($id_osc)
    {
        try {
            $ps_conferencias = $this->service->getParticipacaoSocialConferenciaPorOSC($id_osc);

            if (count($ps_conferencias) == 0)
            {
                return response()->json(['Resposta' => 'Nenhum Participação Social Conferência foi encontrado para essa OSC!'], Response::HTTP_OK);
            }

            return $ps_conferencias;
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
            $this->auditService->auditar('novoPartSocialConferencia', 'PartSocialConferencia', $entidade->id_conferencia, $usuario->id_usuario, 'criado', $entidade, $request->ip(), $entidade->id_osc);

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
            $this->auditService->auditar('updatePartSocialConferencia', 'PartSocialConferencia', $id, $usuario->id_usuario, $dados_old, $dados, $request->ip(), $dados_old->id_osc);

            return response()->json($dados, Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_conferencia, Request $request) {
        try {

            $dados_old = $this->service->get($id_conferencia);

            if (!$dados_old)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            if ($this->service->delete($id_conferencia))
            {
                $usuario = Auth::user();
                $this->auditService->auditar('deletePartSocialConferencia', 'PartSocialConferencia', $id_conferencia, $usuario->id_usuario, $dados_old, 'deletado', $request->ip(), $dados_old->id_osc);

                return response()->json(['Resposta' => 'Participação Social Conferência deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
