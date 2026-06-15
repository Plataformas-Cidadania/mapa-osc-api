<?php

namespace App\Http\Controllers;

use App\Models\Osc\AreaAtuacaoRepresentante;
use App\Services\AuditService;
use App\Services\Osc\AreaAtuacaoRepresentanteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AreaAtuacaoRepresentanteController extends Controller
{
    private $auditService;

    private $service;

    /**
     * Create a new controller instance.
     *
     * @param AreaAtuacaoRepresentanteService $service
     */
    public function __construct(AreaAtuacaoRepresentanteService $_service)
    {
        $this->service = $_service;
        $this->auditService = new AuditService();
    }

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

    public function getAreasAtuacaoRepPorOSC($id_osc)
    {
        try {
            return response()->json($this->service->getAreasAtuacaoRepPorOSC($id_osc), Response::HTTP_OK);
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
            $this->auditService->auditar('novoAreaAtuacao', 'AreaAtuacao', $entidade->id_area_atuacao, $usuario->id_usuario, 'criado', $entidade, $request->ip(), $entidade->id_osc);

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
            $this->auditService->auditar('updateAreaAtuacao', 'AreaAtuacao', $id, $usuario->id_usuario, $dados_old, $entidade, $request->ip(), $entidade->id_osc);

            //Retorna novo registro
            return response()->json($entidade, Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id, Request $request) {
        try {

            $dados_old = $this->service->get($id);

            if (!$dados_old)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            if ($this->service->destroy($id))
            {
                $usuario = Auth::user();
                $this->auditService->auditar('deleteAreaAtuacao', 'AreaAtuacao', $id, $usuario->id_usuario, $dados_old, 'deletado', $request->ip(), $dados_old->id_osc);

                return response()->json(['Resposta' => 'Área de Atuação deletada com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
