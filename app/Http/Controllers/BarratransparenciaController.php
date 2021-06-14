<?php

namespace App\Http\Controllers;

use App\Services\Portal\BarratransparenciaService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BarratransparenciaController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param BarratransparenciaService $service
     */
    public function __construct(BarratransparenciaService $service)
    {
        $this->service = $service;
    }

    public function getBarraPorOSC($id_osc)
    {
        try {
            return response()->json($this->service->getBarraPorOSC($id_osc), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request) {
        try {
            $dados = $request->all();

            return response()->json($this->service->store($dados), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_osc) {
        try {
            if ($this->service->delete($id_osc))
            {
                return response()->json(['Resposta' => 'Representação de osc deletada com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
