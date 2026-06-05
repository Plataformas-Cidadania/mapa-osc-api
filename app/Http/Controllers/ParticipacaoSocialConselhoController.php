<?php

namespace App\Http\Controllers;

use App\Models\Osc\ParticipacaoSocialConselho;
use App\Services\AuditService;
use App\Services\Osc\ParticipacaoSocialConselhoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ParticipacaoSocialConselhoController extends Controller
{
    private $auditService;

    private $service;

    /**
     * Create a new controller instance.
     *
     * @param ParticipacaoSocialConselhoService $service
     */
    public function __construct(ParticipacaoSocialConselhoService $_service)
    {
        $this->service = $_service;

        $this->auditService = new AuditService();
    }

    public function getAll()
    {
        try {
            $ps_conselhos = $this->service->getAll();
            if (is_null($ps_conselhos))
            {
                return response()->json(['Resposta' => 'Item Participação Social Conselho não encontrado!'], Response::HTTP_OK);
            }

            return $ps_conselhos;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get($id)
    {
        try {
            $ps_conselho = $this->service->get($id);
            if (is_null($ps_conselho))
            {
                return response()->json(['Resposta' => 'Item Participação Social Conselho não encontrado!'], Response::HTTP_OK);
            }

            return $ps_conselho;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getParticipacaoSocialConselhoPorOSC($id_osc)
    {
        try {
            $conselhos = $this->service->getParticipacaoSocialConselhoPorOSC($id_osc);

            if (count($conselhos) == 0)
            {
                return response()->json(['Resposta' => 'Nenhum Participação Social Conselho foi encontrado para essa OSC!'], Response::HTTP_OK);
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
            $this->auditService->auditar('novoPartSocialConselho', 'PartSocialConselho', $entidade->id_conselho, $usuario->id_usuario, 'criado', $entidade, $request->ip(), $entidade->id_osc);

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
            $this->auditService->auditar('updatePartSocialConselho', 'PartSocialConselho', $id, $usuario->id_usuario, $dados_old, $dados, $request->ip(), $dados_old->id_osc);

            return response()->json($dados, Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_conselho, Request $request) {
        try {

            $dados_old = $this->service->get($id_conselho);

            if (!$dados_old)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            if ($this->service->delete($id_conselho))
            {
                $usuario = Auth::user();
                $this->auditService->auditar('deleteCertificado', 'PartSocialConselho', $id_conselho, $usuario->id_usuario, $dados_old, 'deletado', $request->ip(), $dados_old->id_osc);

                return response()->json(['Resposta' => 'Participação Social Conselho deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
