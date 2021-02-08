<?php

namespace App\Http\Controllers;

use App\Models\Osc\FonteRecursos;
use App\Services\Osc\FonteRecursosService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FonteRecursosController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param FonteRecursosService $service
     */
    public function __construct(FonteRecursosService $_service)
    {
        $this->service = $_service;
    }

    public function getFonteRecursosPorOSC($id_osc)
    {
        try {
            return response()->json($this->service->getFonteRecursosPorOSC($id_osc), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    //cd_fonte_recurso_osc + ano formatado (yyyy)
    public function getAnoFonteRecursosPorOSC($id_osc)
    {
        try {
            return response()->json($this->service->getAnoFonteRecursosPorOSC($id_osc), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request)
    {
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

            $fonte = $this->service->update($id, $dados);

            if ($fonte)
            {
                return response()->json(['Resposta' => 'Fonte de Recurso atualizada com sucesso!'], Response::HTTP_OK);
            }

            return $fonte;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function delete($id) {
        try {
            if ($this->service->delete($id))
            {
                return response()->json(['Resposta' => 'Fonte de Recurso deletada com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
