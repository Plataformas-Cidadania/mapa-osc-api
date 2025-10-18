<?php

namespace App\Http\Controllers\Confocos;

use App\Http\Controllers\Controller;
use App\Services\Confocos\ConselheiroService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConselheiroController extends Controller
{
    private $service;
    /**
     * Create a new controller instance.
     *
     * @param ConselheiroService $service
     */
    public function __construct(ConselheiroService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/conselho",
     *     operationId="getAll",
     *     tags={"Conselheiro"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos os Conselhos",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/Confocos")
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

//    public function getFromUser()
//    {
//        try {
//            return response()->json($this->service->getFromUser(), Response::HTTP_OK);
//        }
//        catch (\Exception $e) {
//            return $e->getMessage();
//        }
//    }

    
    /**
     * @OA\Get(
     *     path="/api/conselho/{osc_id}",
     *     operationId="get",
     *     tags={"Conselheiro"},
     *     @OA\Parameter(
     *       name="osc_id",
     *       in="path",
     *       required=true,
     *       description="Número de identificação do CONSELHO",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna um Conselheiro de acordo com o ID",
     *         @OA\JsonContent(ref="#/components/schemas/Confocos")
     *     ),
     * )
     */
    public function get($id)
    {
        try {
            return response()->json($this->service->getPorId($id), Response::HTTP_OK);
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

    public function update($id_conselheiro, Request $request)
    {
        try {
            $dados = $request->all();

            $conselheiro = $this->service->update($id_conselheiro, $dados);

            if ($conselheiro) {
                return response()->json(['Resposta' => 'Conselheiro atualizado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaConselheirosPorConselho($id_conselho)
    {
        try {
            return response()->json($this->service->getListaConselheirosPorConselho($id_conselho), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_conselheiro)
    {
        try {

            $resposta = $this->service->destroy($id_conselheiro);

            if ($resposta) {
                return response()->json(['Resposta' => 'Conselheiro deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
