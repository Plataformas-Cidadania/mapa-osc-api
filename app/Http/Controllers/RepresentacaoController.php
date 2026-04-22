<?php

namespace App\Http\Controllers;

use App\Services\Portal\RepresentacaoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RepresentacaoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param RepresentacaoService $service
     */
    public function __construct(RepresentacaoService $service)
    {
        $this->service = $service;
    }

    public function getAll()
    {
        try {
            return response()->json($this->service->getAll(), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
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

    public function getRepresetacaoPorOscAndUsuario($id_osc, $id_usuario)
    {
        try {
            return response()->json($this->service->getRepresetacaoPorOscAndUsuario($id_osc, $id_usuario), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getRepresetacaoPorCnpjOsc($cnpj_osc)
    {
        try {
            return response()->json($this->service->getRepresetacaoPorCnpjOsc($cnpj_osc), Response::HTTP_OK);
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

    public function deletePorOscAndUser($id_osc, $id_usuario) {

        try {
            if ($this->service->deletePorOscAndUser($id_osc, $id_usuario))
            {
                return response()->json(['Resposta' => 'Representação de osc deletada com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getRepresetacoesPorUsuario($id_usuario)
    {
        try {
            return response()->json($this->service->getRepresetacoesPorUsuario($id_usuario), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
