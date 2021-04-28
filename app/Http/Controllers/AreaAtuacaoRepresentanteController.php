<?php

namespace App\Http\Controllers;

use App\Models\Osc\AreaAtuacaoRepresentante;
use App\Services\Osc\AreaAtuacaoRepresentanteService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AreaAtuacaoRepresentanteController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param AreaAtuacaoRepresentanteService $service
     */
    public function __construct(AreaAtuacaoRepresentanteService $_service)
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

    public function getFormatado($id)
    {
        try {
            return response()->json($this->service->getFormatado($id), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAreasAtuacaoRepPorOSC($id_osc)
    {
        try {
            return response()->json($this->service->getAreasAtuacaoRepPorOSC($id_osc), Response::HTTP_OK);
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
