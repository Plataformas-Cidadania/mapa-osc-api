<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCCertificado;
use App\Services\Syst\DCCertificadoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCCertificadoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCCertificadoService $service
     */
    public function __construct(DCCertificadoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/certificado",
     *     operationId="getAll",
     *     tags={"Certificado"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos os certificados.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCCertificado")
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

     /**
     * @OA\Get(
     *     path="/api/certificado/{id_certificado}",
     *     operationId="get",
     *     tags={"Certificado"},
     *     @OA\Parameter(
     *       name="id_certificado",
     *       in="path",
     *       required=true,
     *       description="Número de identificação do certificado",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados do certificado de acordo com o número de identificação informado.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCCertificado")
     *         )
     *     )
     * )
     */
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
