<?php

namespace App\Http\Controllers\Confocos;

use App\Http\Controllers\Controller;
use App\Services\Confocos\DCTipoAbrangenciaConselhoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCTipoAbrangenciaConselhoController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCTipoAbrangenciaConselhoService $service
     */
    public function __construct(DCTipoAbrangenciaConselhoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/confocos/tipo_abrangencia",
     *     operationId="getAll",
     *     tags={"Tipo Abrangencia"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos os Tipo Abrangencia.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCTipoAbrangenciaConselho")
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
     *     path="/api/confocos/tipo_abrangencia/{id_tipo_abrangencia}",
     *     operationId="get",
     *     tags={"Tipo Abrangencia"},
     *     @OA\Parameter(
     *       name="id_tipo_abrangencia",
     *       in="path",
     *       required=true,
     *       description="Número de identificação do Tipo Abrangencia.",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados do nivel federativo de acordo com o número de identificação informado.",
     *         @OA\JsonContent(ref="#/components/schemas/DCTipoAbrangenciaConselho")
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

    public function update($id_abrangencia_conselho, Request $request) {
        try {

            $dados = $request->all();

            $tipo_abrangencia = $this->service->update($id_abrangencia_conselho, $dados);

            if ($tipo_abrangencia) {

                return response()->json(['Resposta' => 'Tipo Abrangencia do Conselho atualizado com sucesso!'], Response::HTTP_OK);
            }
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

    public function delete($id) {
        try {
            $resposta = $this->service->delete($id);

            if ($resposta) {
                return response()->json(['Resposta' => 'Tipo Abrangencia do Conselho deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
