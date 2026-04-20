<?php

namespace App\Http\Controllers;

use App\Services\Transferegov\ProgramaService;
use App\Services\Transferegov\TransferegovService;
use App\Util\File;

class TransferegovController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @param ProgramaService $service
     */
    public function __construct(TransferegovService $_service)
    {
        $this->service = $_service;
    }

    public function dataMigration()
    {
        ini_set('memory_limit', '4G');
        try {
            $files = [
                /*'programa' => 'http://repositorio.dados.gov.br/seges/detru/siconv_programa.csv.zip',
                'programa_proposta' => 'http://repositorio.dados.gov.br/seges/detru/siconv_programa_proposta.csv.zip',
                'proposta' => 'http://repositorio.dados.gov.br/seges/detru/siconv_proposta.csv.zip',
                'convenio' => 'http://repositorio.dados.gov.br/seges/detru/siconv_convenio.csv.zip',
                'emenda' => 'http://repositorio.dados.gov.br/seges/detru/siconv_emenda.csv.zip',
                'plano' => 'http://repositorio.dados.gov.br/seges/detru/siconv_plano_aplicacao.csv.zip',
                'empenho' => 'http://repositorio.dados.gov.br/seges/detru/siconv_empenho.csv.zip',
                'desembolso' => 'http://repositorio.dados.gov.br/seges/detru/siconv_desembolso.csv.zip',
                'pagamento' => 'http://repositorio.dados.gov.br/seges/detru/siconv_pagamento.csv.zip',
                'obtvConvenente' => 'http://repositorio.dados.gov.br/seges/detru/siconv_obtv_convenente.csv.zip',
                'historicoSituacao' => 'http://repositorio.dados.gov.br/seges/detru/siconv_historico_situacao.csv.zip',
                'ingressoContrapartida' => 'http://repositorio.dados.gov.br/seges/detru/siconv_ingresso_contrapartida.csv.zip',
                'termoAditivo' => 'http://repositorio.dados.gov.br/seges/detru/siconv_termo_aditivo.csv.zip',
                'prorroga' => 'http://repositorio.dados.gov.br/seges/detru/siconv_prorroga_oficio.csv.zip',
                'meta' => 'http://repositorio.dados.gov.br/seges/detru/siconv_meta_crono_fisico.csv.zip',
                'etapa' => 'http://repositorio.dados.gov.br/seges/detru/siconv_etapa_crono_fisico.csv.zip',
                'consorcio' => 'http://repositorio.dados.gov.br/seges/detru/siconv_consorcios.csv.zip',
                'empenhoDesembolso' => 'http://repositorio.dados.gov.br/seges/detru/siconv_empenho_desembolso.csv.zip',
                'proponente' => 'http://repositorio.dados.gov.br/seges/detru/siconv_proponentes.csv.zip',*/
            ];
            $basePath = '/tmp/mineracao';
            if (!file_exists($basePath)) {
                mkdir($basePath, 0777, true);
            }
            foreach ($files as $name => $url) {
                print("Tabela: {$name}".PHP_EOL);
                
                if(File::downloadZip("{$basePath}/{$name}.zip", $url)){
                    if(File::UnZip("{$basePath}/{$name}.zip","{$basePath}/{$name}")){
                        $csvName = scandir("{$basePath}/{$name}");
                        $data = File::csvToArray("{$basePath}/{$name}/{$csvName[2]}", ";");
                        print("Service start...".PHP_EOL);
                        foreach ($data as $row) {
                            $this->service->whichService($name, $row);
                        }
                        print("Delete file: ".File::deletar("{$basePath}/{$name}/{$csvName[2]}").PHP_EOL);
                        print("Saved".PHP_EOL);
                    }else
                        print("Erro no unzip".PHP_EOL);
                }else
                    print("Erro no download".PHP_EOL);
            }
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
        finally{
            File::deletarPasta($basePath);
        }
    }

}
