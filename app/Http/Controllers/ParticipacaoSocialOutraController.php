<?php

namespace App\Http\Controllers;

use App\Models\Osc\ParticipacaoSocialOutra;
use App\Services\AuditService;
use App\Services\Osc\ParticipacaoSocialOutraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ParticipacaoSocialOutraController extends Controller
{
    private $auditService;

    private $service;

    /**
     * Create a new controller instance.
     *
     * @param ParticipacaoSocialOutraService $service
     */
    public function __construct(ParticipacaoSocialOutraService $_service)
    {
        $this->service = $_service;
        $this->auditService = new AuditService();
    }

    public function get($id)
    {
        try {
            $ps_outra = $this->service->get($id);
            if (is_null($ps_outra))
            {
                return response()->json(['Resposta' => 'Item Participação Social Outros Espaços não encontrado!'], Response::HTTP_OK);
            }

            return $ps_outra;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
                   
    public function getParticipacaoSocialOutraPorOSC($id_osc)
    {
        try {
            $outras = $this->service->getParticipacaoSocialOutraPorOSC($id_osc);

            if (count($outras) == 0)
            {
                return response()->json(['Resposta' => 'Nenhum Participação Social Outros Espaços foi encontrado para essa OSC!'], Response::HTTP_OK);
            }

            return $outras;
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
            $this->auditService->auditar('novoPartSocialOUTRA', 'PartSocialOUTRA', $entidade->id_participacao_social_outra, $usuario->id_usuario, 'criado', $entidade, $request->ip(), $entidade->id_osc);

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
            $this->auditService->auditar('updatePartSocialOUTRA', 'PartSocialOUTRA', $id, $usuario->id_usuario, $dados_old, $dados, $request->ip(), $dados_old->id_osc);

            return response()->json($dados, Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_outra, Request $request) {
        try {

            $dados_old = $this->service->get($id_outra);

            if (!$dados_old)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            if ($this->service->delete($id_outra))
            {
                $usuario = Auth::user();
                $this->auditService->auditar('deleteCertificado', 'Certificado', $id_outra, $usuario->id_usuario, $dados_old, 'deletado', $request->ip(), $dados_old->id_osc);

                return response()->json(['Resposta' => 'Participação Social Outra deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
