<?php

namespace App\Http\Controllers\Confocos;

use App\Http\Controllers\Controller;
use App\Services\Confocos\DocumentoConselhoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentoConselhoController extends Controller
{
    private $service;
    /**
     * Create a new controller instance.
     *
     * @param DocumentoConselhoService $service
     */
    public function __construct(DocumentoConselhoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/confocos/documento_conselho",
     *     operationId="getAll",
     *     tags={"DocumentoConselho"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos os Documentos de Conselho",
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

    /**
     * @OA\Get(
     *     path="/api/confocos/documento_conselho/{id_documento_conselho}",
     *     operationId="get",
     *     tags={"DocumentoConselho"},
     *     @OA\Parameter(
     *       name="osc_id",
     *       in="path",
     *       required=true,
     *       description="Número de identificação do CONSELHO",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna um DocumentoConselho de acordo com o ID",
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

    public function update($id_documento_conselho, Request $request)
    {
        try {
            $dados = $request->all();

            $conselheiro = $this->service->update($id_documento_conselho, $dados);

            if ($conselheiro) {
                return response()->json(['Resposta' => 'DocumentoConselho atualizado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaDocumentosPorConselho($id_conselho)
    {
        try {
            return response()->json($this->service->getListaDocumentosPorConselho($id_conselho), Response::HTTP_OK);
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
                return response()->json(['Resposta' => 'DocumentoConselho deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
