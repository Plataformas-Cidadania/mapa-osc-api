<?php

namespace App\Http\Controllers;

use App\Services\AuditService;
use App\Services\Osc\OscService;
use App\Models\Osc\DadosGerais;
use App\Services\Osc\DadosGeraisService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DadosGeraisController extends Controller
{
    private $auditService;

    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DadosGeraisService $service
     */
    public function __construct(DadosGeraisService $_service)
    {
        $this->service = $_service;
        $this->auditService = new AuditService();
    }

    public function getDescricao($id)
    {
        try {
            return response()->json($this->service->getDescricao($id), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function updateDescricao($id, Request $request) {
        try {
            $dados = $request->all();

            $descricao_old = $this->service->getDescricao($id);

            $descricao = $this->service->updateDescricao($id, $dados);

            if (!$descricao)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            $usuario = Auth::user();
            $this->auditService->auditar('updateDescricao', 'Descricao', $id, $usuario->id_usuario, $descricao_old, $dados, $request->ip(), $id);

            return response()->json($dados, Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
