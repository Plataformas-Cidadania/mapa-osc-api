<?php

namespace App\Http\Controllers;

use App\Models\Osc\ObjetivoOsc;
use App\Services\AuditService;
use Illuminate\Support\Facades\Auth;
use App\Services\Osc\ObjetivoOscService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ObjetivoOscController extends Controller
{
    private $auditService;

    private $service;

    /**
     * Create a new controller instance.
     *
     * @param ObjetivoOscService $service
     */
    public function __construct(ObjetivoOscService $_service)
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

    public function getObjetivosPorOsc($id_osc)
    {
        try {
            return response()->json($this->service->getObjetivosPorOsc($id_osc), Response::HTTP_OK);
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
            $this->auditService->auditar('novoObjetivosODS', 'ObjetivosODS', $entidade->id_objetivo_osc, $usuario->id_usuario, 'criado', $entidade, $request->ip());

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
            $this->auditService->auditar('updateObjetivosODS', 'ObjetivosODS', $id, $usuario->id_usuario, $dados_old, $entidade, $request->ip());

            //Retorna novo registro
            return response()->json($entidade, Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_ods, Request $request) {
        try {
            $dados_old = $this->service->get($id_ods);

            if (!$dados_old)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            if ($this->service->destroy($id_ods))
            {
                $usuario = Auth::user();
                $this->auditService->auditar('deleteObjetivosODS', 'ObjetivosODS', $id_ods, $usuario->id_usuario, $dados_old, 'deletado', $request->ip());

                return response()->json(['Resposta' => 'Objetivo da OSC deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
