<?php

namespace App\Http\Controllers\Confocos;

use App\Http\Controllers\Controller;
use App\Services\Portal\RepresentacaoConselhoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RepresentacaoConselhoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param RepresentacaoConselhoService $service
     */
    public function __construct(RepresentacaoConselhoService $service)
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

    public function get($id_representacao)
    {
        try {
            return response()->json($this->service->get($id_representacao), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getRepresetacaoPorConselhoAndUsuario($id_conselho, $id_usuario)
    {
        try {
            return response()->json($this->service->getRepresetacaoPorConselhoAndUsuario($id_conselho, $id_usuario), Response::HTTP_OK);
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

    public function delete($id_conselho) {
        try {
            if ($this->service->delete($id_conselho))
            {
                return response()->json(['Resposta' => 'Representação de osc deletada com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
