<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCConferencia;
use App\Services\Syst\DCConferenciaService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCConferenciaController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCConferenciaService $service
     */
    public function __construct(DCConferenciaService $_service)
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
