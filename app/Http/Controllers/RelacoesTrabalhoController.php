<?php

namespace App\Http\Controllers;

use App\Services\AuditService;
use App\Models\Osc\RelacoesTrabalho;
use App\Services\Osc\RelacoesTrabalhoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RelacoesTrabalhoController extends Controller
{
    private $auditService;

    private $service;

    /**
     * Create a new controller instance.
     *
     * @param RelacoesTrabalhoService $service
     */
    public function __construct(RelacoesTrabalhoService $_service)
    {
        $this->service = $_service;
        $this->auditService = new AuditService();
    }

    public function get($id)
    {
        try {
            $relacaoTrabalho = $this->service->get($id);
            if (is_null($relacaoTrabalho))
            {
                return response()->json(['Resposta' => 'Relação de Trabalho não encontrada!'], Response::HTTP_OK);
            }

            return $relacaoTrabalho;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getRelacoesTrabalhoPorOSC($id_osc)
    {
        try {
            $relacoes = $this->service->getRelacoesTrabalhoPorOSC($id_osc);

            if (count($relacoes) == 0)
            {
                return response()->json(['Resposta' => 'Nenhuma Relação de Trabalho foi encontrada para essa OSC!'], Response::HTTP_OK);
            }

            return $relacoes;
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

    public function update($id_osc, Request $request) {
        try {
            $dados = $request->all();

            $dados_old = $this->service->get($id_osc);

            $relacaoTrabalho = $this->service->update($id_osc, $dados);

            if ($relacaoTrabalho)
            {
                $usuario = Auth::user();
                $this->auditService->auditar('updateRelTrabalho', 'RelTrabalho', $id_osc, $usuario->id_usuario, $dados_old, $dados, $request->ip(), $dados_old->id_osc);

                return response()->json(['Resposta' => 'Relação de Trabalho atualizada com sucesso!'], Response::HTTP_OK);
            }

            return $relacaoTrabalho;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_relacaoTrabalho, Request $request) {
        try {
            $dados_old = $this->service->get($id_relacaoTrabalho);

            if (!$dados_old)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            if ($this->service->delete($id_relacaoTrabalho))
            {
                $usuario = Auth::user();
                $this->auditService->auditar('deleteCertificado', 'Certificado', $id_certificado, $usuario->id_usuario, $dados_old, 'deletado', $request->ip(), $dados_old->id_osc);

                return response()->json(['Resposta' => 'Relação de Trabalho deletada com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
