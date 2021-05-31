<?php


namespace App\Repositories\Analisys;

use App\Repositories\Analisys\DCPerfilLocalidadeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DCPerfilLocalidadeRepositoryEloquent implements DCPerfilLocalidadeRepositoryInterface
{
    //private $model;

    public function __construct()
    {
        //$this->model = $_modelo;
    }

    public function getEvolucaoQtdOscPorAno($id_localidade)//PAINEL PRINCIPAL DE OSCs da Página Perfil Localidade
    {
        //SERIES
        $query = "SELECT
			localidade, ano_fundacao, quantidade_oscs, fontes
		FROM analysis.vw_perfil_localidade_evolucao_anual
		WHERE localidade = " . "'" . $id_localidade . "'"
        . "ORDER BY ano_fundacao";
        $regs = DB::select($query);

        $mapa = [];
        $fontes = [];
        $mapaAcumulado = [];
        $vetReplace = ['{', '}', '"'];
        $qtd_osc_acumulado = 0;
        foreach ($regs as $reg) {
            //SERIE DE EVOLUÇÃO ANUAL
            $mapa += [$reg->ano_fundacao => $reg->quantidade_oscs];

            //SERIE DO ACUMULADO ANUAL DOS ANOS
            $qtd_osc_acumulado += $reg->quantidade_oscs;
            $mapaAcumulado += [$reg->ano_fundacao => $qtd_osc_acumulado];

            //VETOR AGRUPADO DE FONTES DAS INFORMAÇÕES
            $valorSemChaves = str_replace($vetReplace, '', $reg->fontes);
            $vet = explode(',', $valorSemChaves);
            foreach ($vet as $f) {
                if (array_search($f, $fontes) === false) {
                    array_push($fontes, $f);
                }
            }
        }

        $anoi = min(array_keys($mapa));
        $anof = max(array_keys($mapa));

        //dd($anoi);
        //dd($anof);
        for ($i = $anoi; $i <= $anof; $i++) {
            $ano = array_search($i, $mapa);
            //dd($mapaAcumulado);
            //dd($ano);
            if(!$ano) {
                //dd($i);

                $mapa += [$i => NULL];
                $mapaAcumulado += [$i => NULL];
                //dd($i);
                dd($mapaAcumulado);
                //dd($mapaAcumulado[1922]);
                //$mapaAcumulado += [$i => $mapaAcumulado[$i-1]];
            }
        }

        ksort($mapa);
        $series = array_values($mapa);
        $labels = array_keys($mapa);


        $query = "SELECT
			localidade, nome_localidade, nr_quantidade_osc, rank, tipo_rank
		FROM analysis.vw_perfil_localidade_ranking_quantidade_osc
		WHERE localidade = " . "'" . $id_localidade . "'"
            . " OR rank <= 1 
                OR rank = (
                    SELECT MAX(rank) FROM analysis.vw_perfil_localidade_ranking_quantidade_osc WHERE tipo_rank = 'municipio'
                )
                OR (
                        rank = (SELECT MAX(rank) FROM analysis.vw_perfil_localidade_ranking_quantidade_osc WHERE tipo_rank = 'estado')  
                        AND tipo_rank = 'estado'
                )
            ORDER BY rank, tipo_rank LIMIT 6";
        $regs = DB::select($query);

        if (count($regs) > 5) {
            $nr_colocacao_nacional = $regs[3]->rank;
            $nr_quantidade_oscs_primeiro_colocado_estado = $regs[0]->nr_quantidade_osc;
            $nr_quantidade_oscs_primeiro_colocado_municipio = $regs[1]->nr_quantidade_osc;
            $nr_quantidade_oscs_ultimo_colocado_estado = $regs[4]->nr_quantidade_osc;
            $nr_quantidade_oscs_ultimo_colocado_municipio = $regs[5]->nr_quantidade_osc;

            $tx_primeiro_colocado_estado = $regs[0]->nome_localidade;
            $tx_primeiro_colocado_municipio = $regs[1]->nome_localidade;
            $tx_ultimo_colocado_estado = $regs[4]->nome_localidade;
            $tx_ultimo_colocado_municipio = $regs[5]->nome_localidade;
        }

        $resultado = ['qtd_osc_por_ano' => [
            'nr_colocacao_nacional' => $nr_colocacao_nacional,
            'nr_quantidade_oscs_primeiro_colocado_estado' => $nr_quantidade_oscs_primeiro_colocado_estado,
            'nr_quantidade_oscs_primeiro_colocado_municipio' => $nr_quantidade_oscs_primeiro_colocado_municipio,
            'nr_quantidade_oscs_ultimo_colocado_estado' => $nr_quantidade_oscs_ultimo_colocado_estado,
            'nr_quantidade_oscs_ultimo_colocado_municipio' => $nr_quantidade_oscs_ultimo_colocado_municipio,

            'tx_primeiro_colocado_estado' => $tx_primeiro_colocado_estado,
            'tx_primeiro_colocado_municipio' => $tx_primeiro_colocado_municipio,
            'tx_ultimo_colocado_estado' => $tx_ultimo_colocado_estado,
            'tx_ultimo_colocado_municipio' => $tx_ultimo_colocado_municipio,

            'dataLabels' => $labels,
            'series' => [
                [
                    'type' => 'line',
                    'name' => 'Quantidade de OSCs',
                    'data' => $series
                ],
                [
                    'type' => 'line',
                    'name' => 'Quantidade de OSCs Acumuladas',
                    'data' => 0
                ],
            ],
            'fontes' => $fontes
        ]];

        return $resultado;
    }

    public function getCaracteristicas($id_localidade)
    {
        //SERIES
        $query = "SELECT
			localidade, 
            nome_localidade,
            tipo_localidade,
            nr_quantidade_osc,
            ft_quantidade_osc,
            nr_quantidade_trabalhadores,
            ft_quantidade_trabalhadores,
            nr_quantidade_recursos,
            ft_quantidade_recursos,
            nr_quantidade_projetos,
            ft_quantidade_projetos,
            nr_orcamento_empenhado,
            ft_orcamento_empenhado
		FROM analysis.vw_perfil_localidade_caracteristicas
		WHERE localidade = " . "'" . $id_localidade . "'";
        $regs = DB::select($query);

        $perfil = $regs[0];

        $vetReplace = ['{', '}', '"'];
        $fontes_orcamento = [];
        $valorSemChaves = str_replace($vetReplace, '', $perfil->ft_orcamento_empenhado);
        $vet = explode(',', $valorSemChaves);
        foreach ($vet as $f) {
            if (array_search($f, $fontes_orcamento) === false) {
                array_push($fontes_orcamento, $f);
            }
        }

        $fontes_qtd_oscs = [];
        $valorSemChaves = str_replace($vetReplace, '', $perfil->ft_quantidade_osc);
        $vet = explode(',', $valorSemChaves);
        foreach ($vet as $f) {
            if (array_search($f, $fontes_qtd_oscs) === false) {
                array_push($fontes_qtd_oscs, $f);
            }
        }

        $fontes_qtd_projetos = [];
        $valorSemChaves = str_replace($vetReplace, '', $perfil->ft_quantidade_projetos);
        $vet = explode(',', $valorSemChaves);
        foreach ($vet as $f) {
            if (array_search($f, $fontes_qtd_projetos) === false) {
                array_push($fontes_qtd_projetos, $f);
            }
        }

        $fontes_qtd_recursos = [];
        $valorSemChaves = str_replace($vetReplace, '', $perfil->ft_quantidade_recursos);
        $vet = explode(',', $valorSemChaves);
        foreach ($vet as $f) {
            if (array_search($f, $fontes_qtd_recursos) === false) {
                array_push($fontes_qtd_recursos, $f);
            }
        }

        $fontes_qtd_trabalhadores = [];
        $valorSemChaves = str_replace($vetReplace, '', $perfil->ft_quantidade_trabalhadores);
        $vet = explode(',', $valorSemChaves);
        foreach ($vet as $f) {
            if (array_search($f, $fontes_qtd_trabalhadores) === false) {
                array_push($fontes_qtd_trabalhadores, $f);
            }
        }

        $resultado = ['caracteristicas' => [
            'ft_orcamento_empenhado' => $fontes_orcamento,
            'ft_quantidade_osc' => $fontes_qtd_oscs,
            'ft_quantidade_projetos' => $fontes_qtd_projetos,
            'ft_quantidade_recursos' => $fontes_qtd_recursos,
            'ft_quantidade_trabalhadores' => $fontes_qtd_trabalhadores,

            'nr_orcamento_empenhado' => floatval($perfil->nr_orcamento_empenhado),
            'nr_quantidade_osc' => $perfil->nr_quantidade_osc,
            'nr_quantidade_projetos' => $perfil->nr_quantidade_projetos,
            'nr_quantidade_recursos' => floatval($perfil->nr_quantidade_recursos),
            'nr_quantidade_trabalhadores' => $perfil->nr_quantidade_trabalhadores,
        ]];

        return $resultado;
    }

    public function getQtdNaturezaJuridica($id_localidade)
    {
        //SERIES PARA GRAFICO PRINCIPAL
        $query = "SELECT
			localidade, 
            natureza_juridica,
            quantidade_oscs,
            fontes
		FROM analysis.vw_perfil_localidade_natureza_juridica
		WHERE localidade = " . "'" . $id_localidade . "'";
        $regs = DB::select($query);

        $fontes = [];
        $series = [];
        $labels = [];
        $vetReplace = ['{', '}', '"'];
        foreach ($regs as $nat) {
            array_push($series, $nat->quantidade_oscs);
            array_push($labels, $nat->natureza_juridica);
            $valorSemChaves = str_replace($vetReplace, '', $nat->fontes);
            $vet = explode(',', $valorSemChaves);
            foreach ($vet as $f) {
                if (array_search($f, $fontes) === false) {
                    array_push($fontes, $f);
                }
            }
        }

        //DADOS DO TEXTO DO GRAFICO
        $query = "SELECT
            natureza_juridica,
            porcertagem_maior
		FROM analysis.vw_perfil_localidade_maior_natureza_juridica
		WHERE localidade = " . "'" . $id_localidade . "'";
        $regs = DB::select($query);

        $natureza_juridica = ($regs[0])->natureza_juridica;
        $nr_porcentagem_maior = ($regs[0])->porcertagem_maior;

        $query = "SELECT
            dado,
            valor
		FROM analysis.vw_perfil_localidade_media_nacional
		WHERE tipo_dado = 'maior_natureza_juridica'";
        $regs = DB::select($query);

        $nr_porcentagem_maior_media_nacional = ($regs[0])->valor;
        $tx_porcentagem_maior_media_nacional = ($regs[0])->dado;

        //JSON RESULTANTE
        $resultado = ['natureza_juridica' => [
            'nr_porcentagem_maior' => floatval($nr_porcentagem_maior),
            'nr_porcentagem_maior_media_nacional' => floatval($nr_porcentagem_maior_media_nacional),
            'tx_porcentagem_maior' => str_replace($vetReplace, '', $natureza_juridica),
            'tx_porcentagem_maior_media_nacional' => str_replace($vetReplace, '', $tx_porcentagem_maior_media_nacional),
            'labels' => $labels,
            'series' => [
                'type' => 'column',
                'name' => 'Quantidades de OSCs',
                'data' => $series
                ],
            'fontes' => $fontes
        ]];

        return $resultado;
    }

    public function getRepasseRecursos($id_localidade)
    {
        //SERIES PARA GRAFICO PRINCIPAL
        $query = "SELECT
			localidade, 
            fonte_recursos,
            ano,
            valor_recursos,
            fontes
		FROM analysis.vw_perfil_localidade_repasse_recursos
		WHERE localidade = " . "'" . $id_localidade . "'
		ORDER BY ano";
        $regs = DB::select($query);

        $fontes = [];
        $mapaAno = [];
        $vetOrigens = [];
        $vetReplace = ['{', '}', '"'];
        foreach ($regs as $rec) {
            if ($rec->ano != null) {
                $mapaFonteValor = [$rec->fonte_recursos => floatval($rec->valor_recursos)];
                if (array_search($rec->fonte_recursos, $vetOrigens) === false) {
                    array_push($vetOrigens, $rec->fonte_recursos);
                }
                if (!array_key_exists($rec->ano, $mapaAno)) {
                    $mapaAno += [$rec->ano => $mapaFonteValor];
                }
                else {
                    $mapaAno[$rec->ano] += $mapaFonteValor;

                }
                $valorSemChaves = str_replace($vetReplace, '', $rec->fontes);
                $vet = explode(',', $valorSemChaves);
                foreach ($vet as $f) {
                    if (array_search($f, $fontes) === false) {
                        array_push($fontes, $f);
                    }
                }
            }
        }
        array_filter($mapaAno);
        $anoi = min(array_keys($mapaAno));
        $anof = max(array_keys($mapaAno));
        $series = [];

        $somaRecursos = 0;
        $qtdRecursos = 0;
        foreach ($vetOrigens as $origen) {
            $data = [];
            for ($i = $anoi; $i <= $anof; $i++) {
                $mapaFonteValor = $mapaAno[$i];
                if (!array_key_exists($origen, $mapaFonteValor)) {
                    $mapaFonteValor = [$origen => null];
                    $mapaAno[$i] += $mapaFonteValor;
                }
                $somaRecursos += $mapaFonteValor[$origen];
                $qtdRecursos += 1;
                array_push($data, $mapaFonteValor[$origen]);
            }
            array_push($series, ['type' => 'line', 'name' => $origen, 'data' => $data]);
        }
        $labels = array_keys($mapaAno);

        //DADOS DO TEXTO DO GRAFICO
        $query = "SELECT
			rank
		FROM analysis.vw_perfil_localidade_ranking_repasse_recursos
		WHERE localidade = " . "'" . $id_localidade . "'";
        $regs = DB::select($query);

        $nr_rank = $regs[0]->rank;

        $query = "SELECT
			dado,
            valor
		FROM analysis.vw_perfil_localidade_media_nacional
		WHERE tipo_dado = 'media_repasse_recursos'";
        $regs = DB::select($query);

        $nr_repasse_media_nacional = $regs[0]->valor;

        $query = "SELECT
			tipo_repasse,
            media,
            porcertagem_maior,
            fontes
		FROM analysis.vw_perfil_localidade_maior_media_repasse_recursos
		WHERE localidade = " . "'" . $id_localidade . "'";
        $regs = DB::select($query);

        $tx_maior_tipo_repasse = $regs[0]->tipo_repasse;
        $nr_porcentagem_maior = $regs[0]->porcertagem_maior;
        $nr_repasse_media = $somaRecursos / $qtdRecursos;

        //JSON RESULTANTE
        $resultado = ['repasse_recursos' => [
            'nr_colocacao_nacional' => floatval($nr_rank),
            'nr_porcentagem_maior_tipo_repasse' => floatval($nr_porcentagem_maior),
            'nr_repasse_media' => ($nr_repasse_media),
            'nr_repasse_media_nacional' => floatval($nr_repasse_media_nacional),
            'tx_maior_tipo_repasse' => $tx_maior_tipo_repasse,
            'labels' => $labels,
            'series' => $series,
            'fontes' => $fontes
        ]];

        return $resultado;
    }

    public function getTransferenciasFederais($id_localidade)
    {
        //SERIES PARA GRAFICO PRINCIPAL
        $query = "SELECT
			localidade, 
            nome_localidade,
            ano,
            empenhado,
            fontes
		FROM analysis.vw_perfil_localidade_orcamento
		WHERE localidade = " . "'" . $id_localidade . "'
		ORDER BY ano";
        $regs = DB::select($query);



        $fontes = [];
        $series = [];
        $labels = [];
        $vetReplace = ['{', '}', '"'];
        foreach ($regs as $nat) {
            array_push($series, $nat->empenhado);
            array_push($labels, $nat->ano);

            //TRATAMENTO DE FONTES
            $valorSemChaves = str_replace($vetReplace, '', $nat->fontes);
            $vet = explode(',', $valorSemChaves);
            foreach ($vet as $f) {
                if (array_search($f, $fontes) === false) {
                    array_push($fontes, $f);
                }
            }
        }

        //VALORES REFERENTES A MEDIAS DE TRANSFERENCIAS
        $query = "SELECT
			tipo_localidade, 
            media,
            quantidade_localidades
		FROM analysis.vw_perfil_localidade_orcamento_media_nacional";
        $regs = DB::select($query);

        $reg = $regs[2];
        $nr_media = $reg->media;
        $nr_quantidade_localidade = $reg->quantidade_localidades;

        //JSON RESULTANTE
        $resultado = ['transferencias_federais' => [
            'media' => floatval($nr_media),
            'quantidade_localidades' => floatval($nr_quantidade_localidade),
            'labels' => $labels,
            'series' => [
                'type' => 'line',
                'name' => 'Orçamento Empenhado',
                'data' => $series
            ],
            'fontes' => $fontes
        ]];

        return $resultado;
    }

    public function getQtdOscPorAreasAtuacao($id_localidade)
    {
        //SERIES PARA GRAFICO PRINCIPAL
        $query = "SELECT
			localidade, 
            area_atuacao,
            quantidade_oscs,
            fontes
		FROM analysis.vw_perfil_localidade_area_atuacao
		WHERE localidade = " . "'" . $id_localidade . "'";
        $regs = DB::select($query);



        $fontes = [];
        $series = [];
        $labels = [];
        $vetReplace = ['{', '}', '"'];
        $tx_porcentagem_maior = '';
        $maiorValor = 0;
        foreach ($regs as $area) {
            array_push($series, $area->quantidade_oscs);
            array_push($labels, $area->area_atuacao);
            if ($maiorValor < $area->quantidade_oscs) {
                $maiorValor = $area->quantidade_oscs;
                $tx_porcentagem_maior = $area->area_atuacao;
            }

            //TRATAMENTO DE FONTES
            $valorSemChaves = str_replace($vetReplace, '', $area->fontes);
            $vet = explode(',', $valorSemChaves);
            foreach ($vet as $f) {
                if (array_search($f, $fontes) === false) {
                    array_push($fontes, $f);
                }
            }
        }

        //VALORES REFERENTES A MEDIAS NACIONAIS AREA DE ATUAÇÃO
        $query = "SELECT
			tipo_dado, 
            dado,
            valor
		FROM analysis.vw_perfil_localidade_media_nacional
		WHERE tipo_dado = 'maior_area_atuacao'";
        $regs = DB::select($query);

        $reg = $regs[0];
        $nr_area_atuacao = $reg->valor;
        $tx_area_atuacao = ($reg->dado);

        //VALORES REFERENTES A MEDIAS NACIONAIS AREA DE ATUAÇÃO
        $query = "SELECT
			localidade, 
            area_atuacao,
            porcertagem_maior,
            fontes
		FROM analysis.vw_perfil_localidade_maior_area_atuacao
		WHERE localidade = " . "'" . $id_localidade . "'";
        $regs = DB::select($query);

        $reg = $regs[0];
        $nr_porcentagem_maior = $reg->porcertagem_maior;
        $tx_porcentagem_maior = ($reg->area_atuacao);


        //TRATAMENTO DE FONTES
        $valorSemChaves = str_replace($vetReplace, '', $reg->fontes);
        $vet = explode(',', $valorSemChaves);
        foreach ($vet as $f) {
            if (array_search($f, $fontes) === false) {
                array_push($fontes, $f);
            }
        }

        //JSON RESULTANTE
        $resultado = ['qtd_area_atuacao' => [
            'nr_media_nacional_area_atuacao' => floatval($nr_area_atuacao),
            'tx_media_nacional_area_atuacao' => str_replace($vetReplace, '', $tx_area_atuacao),
            'nr_porcentagem_maior' => floatval($nr_porcentagem_maior),
            'tx_porcentagem_maior' => str_replace($vetReplace, '', $tx_porcentagem_maior),
            'labels' => $labels,
            'series' => [
                'type' => 'line',
                'name' => 'Área de Atuação',
                'data' => $series
            ],
            'fontes' => $fontes
        ]];

        return $resultado;
    }

    public function getQtdTrabalhadores($id_localidade)
    {
        //SERIES PARA GRAFICO PRINCIPAL
        $query = "SELECT
			localidade, 
            vinculos,
            deficiencia,
            voluntarios,
            total,
            fontes
		FROM analysis.vw_perfil_localidade_trabalhadores
		WHERE localidade = " . "'" . $id_localidade . "'";
        $regs = DB::select($query);

        $fontes = [];
        $series = [];
        $labels = [];
        $vetReplace = ['{', '}', '"'];
        $reg = $regs[0];

        {
            array_push($series, $reg->deficiencia);
            array_push($labels, 'Vínculos formais de pessoas com deficiência');

            array_push($series, $reg->vinculos);
            array_push($labels, 'Vínculos formais');

            array_push($series, $reg->voluntarios);
            array_push($labels, 'Trabalhadores voluntários');

            //TRATAMENTO DE FONTES
            $valorSemChaves = str_replace($vetReplace, '', $reg->fontes);
            $vet = explode(',', $valorSemChaves);
            foreach ($vet as $f) {
                if (array_search($f, $fontes) === false) {
                    array_push($fontes, $f);
                }
            }
        }

        //JSON RESULTANTE
        $resultado = ['qtd_trabalhores' => [
            'nr_total_trabalhadores' => $reg->total,
            'labels' => $labels,
            'series' => [
                'type' => 'bar',
                'name' => 'Número de Trabalhores',
                'data' => $series
            ],
            'fontes' => $fontes
        ]];

        return $resultado;
    }
}