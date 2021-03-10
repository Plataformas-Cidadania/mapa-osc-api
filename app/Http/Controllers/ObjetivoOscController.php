<?php

namespace App\Http\Controllers;

use App\Models\Osc\ObjetivoOsc;
use App\Services\Osc\ObjetivoOscService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ObjetivoOscController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param ObjetivoOscService $service
     */
    public function __construct(ObjetivoOscService $_service)
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

                return response()->json(['Resposta' => 'Objetivo da OSC atualizado com sucesso!'], Response::HTTP_OK);
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
                return response()->json(['Resposta' => 'Objetivo da OSC deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
