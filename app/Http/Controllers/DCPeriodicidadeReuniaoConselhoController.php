<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCPeriodicidadeReuniaoConselho;
use App\Services\Syst\DCPeriodicidadeReuniaoConselhoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCPeriodicidadeReuniaoConselhoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCPeriodicidadeReuniaoConselhoService $service
     */
    public function __construct(DCPeriodicidadeReuniaoConselhoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/ps_conselhos_periodicidade",
     *     operationId="getAll",
     *     tags={"Participação social"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todas as participações sociais concelhos periodicidade.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCPeriodicidadeReuniaoConselho")
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
