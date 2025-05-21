<?php

namespace App\Http\Controllers;

use App\Models\Syst\DCQualificacaoSocio;
use App\Services\Syst\DCQualificacaoSocioService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DCQualificacaoSocioController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param DCQualificacaoSocioService $service
     */
    public function __construct(DCQualificacaoSocioService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/qualificacao-socio/{id_qualificacao-socio}",
     *     operationId="get",
     *     tags={"Quadro societário"},
     *     @OA\Parameter(
     *       name="id_qualificacao-socio",
     *       in="path",
     *       required=true,
     *       description="Número de identificação das qualificações de sócio.",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna dados das qualificações de sócio de acordo com o número de identificação informado.",
     *         @OA\JsonContent(ref="#/components/schemas/DCQualificacaoSocio")
     *     )
     * )
     */
    public function get($id)
    {
        try {
            $qualificao_socio = $this->service->get($id);
            if (is_null($qualificao_socio))
            {
                return response()->json(['Resposta' => 'Qualificação de Sócio não encontrado!'], Response::HTTP_OK);
            }

            return $qualificao_socio;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @OA\Get(
     *     path="/api/qualificacao-socio/all",
     *     operationId="getAll",
     *     tags={"Quadro societário"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todas as qualificações de sócio.",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/DCQualificacaoSocio")
     *         )
     *     )
     * )
     */
    public function getAll()
    {
        try {
            $qualificao_socios = $this->service->getAll();

            if (count($qualificao_socios) == 0)
            {
                return response()->json(['Resposta' => 'Nenhuma Qualificação de Sócio foi encontrado!'], Response::HTTP_OK);
            }

            return $qualificao_socios;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request) {
        try {
            $dados = $request->all();

            //Retorna novo registro
            return response()->json($this->service->store($dados), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($id, Request $request) {
        try {
            $dados = $request->all();

            $qualificao_socio = $this->service->update($id, $dados);

            if ($qualificao_socio)
            {
                return response()->json(['Resposta' => 'Qualificação de Sócio atualizado com sucesso!'], Response::HTTP_OK);
            }

            return $qualificao_socio;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id_qualificacao_socio) {
        try {
            if ($this->service->delete($id_qualificacao_socio))
            {
                return response()->json(['Resposta' => 'Qualificação de Sócio deletado com sucesso!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
