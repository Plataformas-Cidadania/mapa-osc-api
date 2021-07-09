<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCZonaAtuacaoProjeto;
use App\Services\Syst\DCZonaAtuacaoProjetoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCZonaAtuacaoProjetoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCZonaAtuacaoProjetoService $service
     */
    public function __construct(DCZonaAtuacaoProjetoService $_service)
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

    }

    public function store(Request $request) {

    }

    public function delete($id) {

    }
}
