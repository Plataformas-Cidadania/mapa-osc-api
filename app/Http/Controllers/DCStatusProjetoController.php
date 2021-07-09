<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCStatusProjeto;
use App\Services\Syst\DCStatusProjetoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCStatusProjetoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCStatusProjetoService $service
     */
    public function __construct(DCStatusProjetoService $_service)
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
