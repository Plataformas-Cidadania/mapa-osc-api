<?php

namespace App\Http\Controllers;

use App\Models\Osc\Recurso;
use App\Services\Osc\RecursosOSCService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecursosOSCController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param RecursosOSCService $service
     */
    public function __construct(RecursosOSCService $_service)
    {
        $this->service = $_service;
    }

    public function getRecursosPorOSC($id_osc)
    {
        try {
            return response()->json($this->service->getRecursosPorOSC($id_osc), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function getNRecursosPorOSC($id_osc)
    {
        try {
            return response()->json($this->service->getNRecursosPorOSC($id_osc), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    //cd_fonte_recurso_osc + ano formatado (yyyy)
    public function getAnoRecursosPorOSC($id_osc)
    {
        try {
            return response()->json($this->service->getAnoRecursosPorOSC($id_osc), Response::HTTP_OK);
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
                return response()->json(['Resposta' => 'Recurso atualizado com sucesso!'], Response::HTTP_OK);
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
                return response()->json(['Resposta' => 'Recurso deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
