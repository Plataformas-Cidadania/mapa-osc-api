<?php

namespace App\Http\Controllers;

use App\Services\Confocos\ConselhoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\Response;

class ConselhoController extends Controller
{
    private $service;
    /**
     * Create a new controller instance.
     *
     * @param ConselhoService $service
     */
    public function __construct(ConselhoService $_service)
    {
        $this->service = $_service;
    }

    /**
     * @OA\Get(
     *     path="/api/conselho",
     *     operationId="getAll",
     *     tags={"Conselho"},
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
     *     tags={"Conselho"},
     *     @OA\Parameter(
     *       name="osc_id",
     *       in="path",
     *       required=true,
     *       description="Número de identificação do CONSELHO",
     *       @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Retorna um Conselho de acordo com o ID",
     *         @OA\JsonContent(ref="#/components/schemas/Confocos")
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

    public function getNumeroTotalConselhos()
    {
        try {
            return response()->json($this->service->getNumeroTotalConselhos(), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request) {
    }

    public function getListaConselhosPorNivelFederativo($tam_lista)
    {
        try {
            return response()->json($this->service->getListaConselhosPorNivelFederativo($tam_lista), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getListaConselhosUsuarioAutenticado(){
        try {
            return response()->json($this->service->getListaConselhosUsuarioAutenticado(), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

//    public function getListaOscCnpjAutocomplete($cnpj){
//        try {
//            return response()->json($this->service->getListaOscCnpjAutocomplete($cnpj), Response::HTTP_OK);
//        }
//        catch (\Exception $e) {
//            return $e->getMessage();
//        }
//    }

//    public function getListaOscNomeCnpjAutocomplete(Request $request){
//
//        //Retorira zeros inciais pelo fato do CNPJ ser armazenado em NUMERIC no BD e Isso faz com que os Zeros não sejam gravados
//        $texto_busca = preg_replace('/^0+/', '', $request->texto_busca) ?: '0';
//
//        //Retira os pontos do CNPJ, pois no BD somente são guardados os Números (CNPJ é um campo NUMERIC)
//        $texto_busca = str_replace("%20", " ", $texto_busca);
//
//        $quantidade_aspas_simples = substr_count($texto_busca, "'");
//        if ($quantidade_aspas_simples / 2 !== 0)
//            $texto_busca = str_replace("'", "", $texto_busca);
//
//        try {
//            return response()->json($this->service->getListaOscNomeCnpjAutocomplete($texto_busca), Response::HTTP_OK);
//        }
//        catch (\Exception $e) {
//            return $e->getMessage();
//        }
//    }
}
