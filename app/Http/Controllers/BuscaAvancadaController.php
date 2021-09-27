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

                    $rows = $this->service->buscarOSCs($type_result, $param, $busca);
                    if($type_result == 'geo'){
                        $oscs = [];
                        foreach ($rows as $item) {
                            if(!empty($item->geo_lat)){
                                array_push($oscs, [$item->id_osc, $item->geo_lat, $item->geo_lng]);
                            }
                        }
                        $rows = $oscs;
                    }
                    return response()->json($rows, Response::HTTP_OK);
                    //return response()->json($this->service->buscarOSCs($type_result, $param, $busca), Response::HTTP_OK);
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
                    $lista_oscs = $this->service->buscarOSCs($type_result, $param, $busca);

                    //$json_teste = [497385,579266,613127,623997,707335,707343,708052,709665,711909,712289];

                    $lista_ids_oscs = [];
                    foreach ($lista_oscs as $osc) {
                        array_push($lista_ids_oscs, $osc->id_osc);
                    }

                    $lista_indices = [];
                    if(property_exists($busca, 'Adicionais')){
                        foreach ($busca->Adicionais as $key=>$indice) {
                            $temp = explode("-", $key);
                            array_push($lista_indices, $temp[1]);
                        }
                    }
                    $rows = $this->service->exportarOSCs($lista_ids_oscs, $lista_indices);
                    $columns = "";
                    foreach ($rows[0] as $index => $value) {
                        $columns .= $index.";";
                    }
                    $columns = substr($columns, 0, -1);
                    $csv = "$columns\n";
                    foreach ($rows as $item) {
                        $linha = "";
                        foreach ($item as $value) {
                            $linha .= $value.";";
                        }
                        $linha = substr($linha, 0, -1);
                        $csv .= "$linha\n";
                    }
                    return $csv;
                    //return response()->json($this->service->exportarOSCs($lista_ids_oscs, $lista_indices), Response::HTTP_OK);

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
