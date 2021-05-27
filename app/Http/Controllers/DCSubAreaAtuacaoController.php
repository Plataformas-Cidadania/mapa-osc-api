<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCAreaAtuacao;
use App\Services\Syst\DCSubAreaAtuacaoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCSubAreaAtuacaoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCSubAreaAtuacaoService $service
     */
    public function __construct(DCSubAreaAtuacaoService $_service)
    {
        $this->service = $_service;
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

    public function update($id, Request $request) {
        try {
            $dados = $request->all();

            return response()->json($this->service->update($id, $dados), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request) {

    }

    public function delete($id) {

    }
}
