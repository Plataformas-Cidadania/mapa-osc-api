<?php

namespace App\Http\Controllers;

use App\Services\Portal\BuscaAvancadaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class BuscaAvancadaController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param BuscaAvancadaService $service
     */
    public function __construct(BuscaAvancadaService $_service)
    {
        $this->service = $_service;
    }

    public function buscarOSCs(Request $request, $type_result, $limit = 0, $offset = 0)
    {

        try {
            $param = [$limit, $offset];

            if($request->input('avancado')) {
                $avancado = $request->input('avancado');

                if(gettype($avancado) == 'string'){
                    $avancadoAjustado = array();

                    foreach(json_decode($avancado) as $key => $value){
                        $avancadoAjustado[$key] = (array) $value;
                    }

                    $avancado = $avancadoAjustado;
                }

                if(is_array($avancado)) {
                    $busca = (object) $avancado;
                } else{
                    $busca = json_decode($avancado);
                }

                if(
                    isset($busca->dadosGerais) || isset($busca->areasSubareasAtuacao) || isset($busca->atividadeEconomica) ||
                    isset($busca->titulacoesCertificacoes) || isset($busca->relacoesTrabalhoGovernanca) || isset($busca->espacosParticipacaoSocial) ||
                    isset($busca->projetos) || isset($busca->fontesRecursos) || isset($busca->IDH)
                )
                {
                    //$resultado = new \stdClass();
                    //dd('teste');
                    return response()->json($this->service->buscarOSCs($type_result, $param, $busca), Response::HTTP_OK);
                    //$buscaAvancadoDao = $this->dao->searchAdvancedList($type_result, $param, $busca);
                    //$resultado->lista_osc = $buscaAvancadoDao;

                    //$listaId = array_keys($buscaAvancadoDao);
                    //array_shift($listaId);

                    //$listaChave = $busca;
                    //unset($listaChave->Adicionais);

                    //$cache = new \stdClass();
                    //$cache->chave = md5(serialize($listaChave));
                    //$cache->valor = '{' . implode(",", $listaId) . '}';

                    //$resultado->chave_cache_exportar = $cache->chave;

                    //(new CacheExportarDao())->inserirExportar($cache);

                    //$this->configResponse($resultado);
                }else{
                    return response()->json(['Resposta' => 'Atributos(s) obrigatório(s) não enviado(s)!'], Response::HTTP_OK);
                    //$resultado = ['msg' => 'Atributos(s) obrigatório(s) não enviado(s).'];
                    //$this->configResponse($resultado, 400);
                }
            }else{
                return response()->json(['Resposta' => 'Dado(s) obrigatório(s) não enviado(s)!'], Response::HTTP_OK);
                //$resultado = ['msg' => 'Dado(s) obrigatório(s) não enviado(s).'];
                //$this->configResponse($resultado, 400);
            }

            //return $this->response();
            //return response()->json($this->service->buscarOSCs($type_result, $param, $busca), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function exportarOSCs(Request $request){
        try {
            $type_result = 'exportar';
            $param = null;
            $type_result = 'lista';

            if($request->input('avancado')) {
                $avancado = $request->input('avancado');

                if(gettype($avancado) == 'string'){
                    $avancadoAjustado = array();

                    foreach(json_decode($avancado) as $key => $value){
                        $avancadoAjustado[$key] = (array) $value;
                    }

                    $avancado = $avancadoAjustado;
                }

                if(is_array($avancado)) {
                    $busca = (object) $avancado;
                } else{
                    $busca = json_decode($avancado);
                }

                if(
                    isset($busca->dadosGerais) || isset($busca->areasSubareasAtuacao) || isset($busca->atividadeEconomica) ||
                    isset($busca->titulacoesCertificacoes) || isset($busca->relacoesTrabalhoGovernanca) || isset($busca->espacosParticipacaoSocial) ||
                    isset($busca->projetos) || isset($busca->fontesRecursos) || isset($busca->IDH)
                )
                {
                    //$resultado = new \stdClass();
                    //dd('teste');
                    $listaOsc = response()->json($this->service->buscarOSCs($type_result, $param, $busca), Response::HTTP_OK);




                }else{
                    return response()->json(['Resposta' => 'Atributos(s) obrigatório(s) não enviado(s)!'], Response::HTTP_OK);
                    //$resultado = ['msg' => 'Atributos(s) obrigatório(s) não enviado(s).'];
                    //$this->configResponse($resultado, 400);
                }
            }else{
                return response()->json(['Resposta' => 'Dado(s) obrigatório(s) não enviado(s)!'], Response::HTTP_OK);
                //$resultado = ['msg' => 'Dado(s) obrigatório(s) não enviado(s).'];
                //$this->configResponse($resultado, 400);
            }

            //return $this->response();
            //return response()->json($this->service->buscarOSCs($type_result, $param, $busca), Response::HTTP_OK);
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
