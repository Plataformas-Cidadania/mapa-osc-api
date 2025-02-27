<?php

namespace App\Http\Controllers;

use App\Services\Osc\OscService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Response;

class OscController extends Controller
{
    private $service;
    /**
     * Create a new controller instance.
     *
     * @param OscService $service
     */
    public function __construct(OscService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/osc",
     *     operationId="getAll",
     *     tags={"osc"},
     *     @OA\Response(
     *         response="200",
     *         description="Retorna todos as OSCs",
     *         @OA\JsonContent(
     *           type="array",
     *           @OA\Items(ref="#/components/schemas/osc")
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

    public function getFromUser()
    {
        try {
            return response()->json($this->service->getFromUser(), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    
    /**
     * @OA\Get(
     *     path="/api/osc/{osc_id}",
     *     operationId="get",
     *     tags={"osc"},
     *     @OA\Parameter(
     *       name="osc_id",
     *       in="path",
     *       required=true,
     *       description="Número de identificação da OSC",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna uma OSC de acordo com o ID",
     *         @OA\JsonContent(ref="#/components/schemas/osc")
     *     ),
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

    public function getNumeroTotalOSCs()
    {
        try {
            return response()->json($this->service->getNumeroTotalOSCs(), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getCabecalho($id)
    {
        try {
            return response()->json($this->service->getCabecalho($id), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getDadosGerais($id)
    {
        try {
            return response()->json($this->service->getDadosGerais($id), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateDadosGerais($id, Request $request)
    {
        try {

            $data = $request->all();

            $dados_gerais = $this->service->updateDadosGerais($id, $data);

            if (!$dados_gerais)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            return \response()->json($dados_gerais, Response::HTTP_OK);

        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateLogo($id, Request $request)
    {
        try {
            $file = $request->file('logo');
            $logo = $this->service->updateLogo($id, $file);

            if (!$logo)
            {
                return response()->json(['Resposta' => 'Objeto não encontrado!'], Response::HTTP_OK);
            }

            return \response()->json($logo, Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getLogo($id)
    {
        try {
            return response()->json($this->service->getLogo($id), Response::HTTP_OK);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getDescricao($id)
    {
        try {
            return response()->json($this->service->getDescricao($id), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function getRelTrabalhoAndGovernanca($id)
    {
        try {
            return response()->json($this->service->getRelTrabalhoAndGovernanca($id), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getProjetos($id)
    {
        try {
            return response()->json($this->service->getProjetos($id), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getParticipacaoSocial($id)
    {
        try {
            return response()->json($this->service->getParticipacaoSocial($id), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($id, Request $request) {
        try {
            $dados = $request->all();

            $osc = $this->service->update($id, $dados);

            if ($osc)
            {
                return response()->json(['Resposta' => 'OSC atualizada com sucesso!'], Response::HTTP_OK);
            }

            return $osc;
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request) {
    }

    public function getListaOscAtualizadas($tam_lista)
    {
        try {
            return response()->json($this->service->getListaOscAtualizadas($tam_lista), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getGrafico($tipo_graf)
    {
        try {
            return response()->json($this->service->getGrafico($tipo_graf), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaOscAreaAtuacaoAndMunicipio($cd_area_atuacao, $cd_municipio, $limit = 5)
    {
        try {
            return response()->json($this->service->getListaOscAreaAtuacaoAndMunicipio($cd_area_atuacao, $cd_municipio, $limit), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaOscAreaAtuacaoAndGEO($cd_area_atuacao, $lat, $lon, $limit = 5)
    {
        try {
            $geo = [
                (double)filter_var($lat, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                (double)filter_var($lon, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)
            ];
            return response()->json($this->service->getListaOscAreaAtuacaoAndGEO($cd_area_atuacao, $geo, $limit), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaOscAreaAtuacao($cd_area_atuacao, $limit = 5)
    {
        try {
            return response()->json($this->service->getListaOscAreaAtuacao($cd_area_atuacao, $limit), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getPopupOSC($id_osc)
    {
        try {
            return response()->json($this->service->getPopupOSC($id_osc), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaOscUsuarioAutenticado(){
        try {
            return response()->json($this->service->getListaOscUsuarioAutenticado(), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaOscCnpjAutocomplete($cnpj){
        try {
            return response()->json($this->service->getListaOscCnpjAutocomplete($cnpj), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaOscNomeCnpjAutocomplete(Request $request){
        $texto_busca = $request->texto_busca;
        try {
            return response()->json($this->service->getListaOscNomeCnpjAutocomplete($texto_busca), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
