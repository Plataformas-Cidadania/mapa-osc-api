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
                    return response()->json($this->service->buscarOSCs($type_result, $param, $busca), Response::HTTP_OK);
                }else{
                    return response()->json(['Resposta' => 'Atributos(s) obrigatório(s) não enviado(s)!'], Response::HTTP_OK);
                }
            }else{
                return response()->json(['Resposta' => 'Dado(s) obrigatório(s) não enviado(s)!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function exportarOSCs(Request $request){
        try {
            $type_result = 'exportar';
            $param = null;
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
                    //$lista_oscs = $this->service->buscarOSCs($type_result, $param, $busca);

                    $json_teste = [497385,
                    579266,
                    613127,
                    623997,
                    707335,
                    707343,
                    708052,
                    709665,
                    711909,
                    712289];

                    /*
                    $lista_oscs = [];
                    foreach ($json_teste as $osc) {
                        array_push($lista_oscs, $osc->id_osc);
                    }
                    */

                    $lista_indices = [];
                    foreach ($busca->Adicionais as $key=>$indice) {
                        $temp = explode("-", $key);
                        array_push($lista_indices, $temp[1]);
                    }

                    return response()->json($this->service->exportarOSCs($json_teste, $lista_indices), Response::HTTP_OK);

                }else{
                    return response()->json(['Resposta' => 'Atributos(s) obrigatório(s) não enviado(s)!'], Response::HTTP_OK);
                }
            }else{
                return response()->json(['Resposta' => 'Dado(s) obrigatório(s) não enviado(s)!'], Response::HTTP_OK);
            }
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
