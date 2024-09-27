<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCTipoSocio;
use App\Services\Syst\DCTipoSocioService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCTipoSocioController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCTipoSocioService $service
     */
    public function __construct(DCTipoSocioService $_service)
    {
        $this->service = $_service;
    }

    public function get($id)
    {
        try {
            $qualificao_socio = $this->service->get($id);
            if (is_null($qualificao_socio))
            {
                return response()->json(['Resposta' => 'Tipo de Sócio não encontrado!'], Response::HTTP_OK);
            }

            return $qualificao_socio;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAll()
    {
        try {
            $qualificao_socios = $this->service->getAll();

            if (count($qualificao_socios) == 0)
            {
                return response()->json(['Resposta' => 'Nenhuma Tipo de Sócio foi encontrado!'], Response::HTTP_OK);
            }

            return $qualificao_socios;
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

            $qualificao_socio = $this->service->update($id, $dados);

            if ($qualificao_socio)
            {
                return response()->json(['Resposta' => 'Tipo de Sócio atualizado com sucesso!'], Response::HTTP_OK);
            }

            return $qualificao_socio;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_qualificacao_socio) {
        try {
            if ($this->service->delete($id_qualificacao_socio))
            {
                return response()->json(['Resposta' => 'Tipo de Sócio deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
