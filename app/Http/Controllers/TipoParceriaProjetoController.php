<?php

namespace App\Http\Controllers;

use App\Models\Osc\TipoParceriaProjeto;
use App\Services\Osc\TipoParceriaProjetoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TipoParceriaProjetoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param TipoParceriaProjetoService $service
     */
    public function __construct(TipoParceriaProjetoService $_service)
    {
        $this->service = $_service;
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

    public function getTipoParceriasPorProjeto($id_projeto)
    {
        try {
            return response()->json($this->service->getTipoParceriasPorProjeto($id_projeto), Response::HTTP_OK);
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

    public function update($id, Request $request) {
        try {
            $dados = $request->all();

            $parceira = $this->service->update($id, $dados);

            if ($parceira) {

                return response()->json(['Resposta' => 'Parceria de Projeto atualizada com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_parceira) {
        try {
            if ($this->service->destroy($id_parceira))
            {
                return response()->json(['Resposta' => 'Parceria de Projeto deletada com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
