<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCClasseAtividadeEconomica;
use App\Services\Syst\DCClasseAtividadeEconomicaService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCClasseAtividadeEconomicaController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCClasseAtividadeEconomicaService $service
     */
    public function __construct(DCClasseAtividadeEconomicaService $_service)
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

    public function getAutocomplete($param)
    {
        try {
            return response()->json($this->service->getAutocomplete($param), Response::HTTP_OK);
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

            $area_atuacao = $this->service->update($id, $dados);

            if ($area_atuacao) {

                return response()->json(['Resposta' => 'Área de Atuação atualizada com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            if ($this->service->destroy($id))
            {
                return response()->json(['Resposta' => 'Área de Atuação deletada com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
