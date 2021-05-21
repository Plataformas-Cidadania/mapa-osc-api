<?php

namespace App\Http\Controllers;

use App\Models\Osc\SemRecurso;
use App\Services\Osc\SemRecursosOSCService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SemRecursosOSCController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param SemRecursosOSCService $service
     */
    public function __construct(SemRecursosOSCService $_service)
    {
        $this->service = $_service;
    }

    public function getAnosSemRecursosPorOSC($id_osc, $ano)
    {
        try {
            return response()->json($this->service->getAnosSemRecursosPorOSC($id_osc, $ano), Response::HTTP_OK);
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

    public function delete($id, Request $request) {
        try {
            $dados = $request->all();
            if ($this->service->delete($id, $dados))
            {
                return response()->json(['Resposta' => 'Recurso deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
