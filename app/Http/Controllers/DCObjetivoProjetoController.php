<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCObjetivoProjeto;
use App\Services\Syst\DCObjetivoProjetoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCObjetivoProjetoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCObjetivoProjetoService $service
     */
    public function __construct(DCObjetivoProjetoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/objetivos",
     *     operationId="getAll",
     *     tags={"Objetivos"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos os objetivos de projeto.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCObjetivoProjeto")
     *         )
     *     )
     * )
     */ 
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
