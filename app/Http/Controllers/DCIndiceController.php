<?php

namespace App\Http\Controllers;

use App\Models\IpeaData\DCIndice;
use App\Services\Ipeadata\DCIndiceService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCIndiceController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCIndiceService $service
     */
    public function __construct(DCIndiceService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/indice_ipeadata",
     *     operationId="getAll",
     *     tags={"Indices"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos os indices do IPEA Data.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCIndice")
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
