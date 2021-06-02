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

    public function store(Request $request) {
        try {
            $dados = $request->all();

            return response()->json($this->service->store($dados), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
        //return [];
        //return ['tx_email_usuario' => 'teste@gmail.com'];
        //return ['tx_nome_usuario' => '', 'tx_email_usuario' => '', 'tx_senha_usuario' => ''];

        //$user = new Usuario($request->all());

        //return $user;
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
