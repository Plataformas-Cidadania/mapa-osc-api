<?php

namespace App\Http\Controllers;

use App\Models\Osc\FonteRecursosProjeto;
use App\Services\Osc\FonteRecursosProjetoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FonteRecursosProjetoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param FonteRecursosProjetoService $service
     */
    public function __construct(FonteRecursosProjetoService $_service)
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

    public function getFonteRecursosPorProjeto($id_projeto)
    {
        try {
            return response()->json($this->service->getFonteRecursosPorProjeto($id_projeto), Response::HTTP_OK);
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

                return response()->json(['Resposta' => 'Fonte de Recursos de Projeto atualizada com sucesso!'], Response::HTTP_OK);
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
                return response()->json(['Resposta' => 'Fonte de Recursos de Projeto deletada com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
