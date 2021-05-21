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

    public function getAll()
    {

    }

    public function getEvolucaoQtdOscPorAno($id_localidade)
    {
        //SERIES
        $query = "SELECT
			localidade, ano_fundacao, quantidade_oscs, fontes
		FROM analysis.vw_perfil_localidade_evolucao_qtd_osc_por_ano
		WHERE localidade = " . "'" . $id_localidade . "'"
        . "ORDER BY ano_fundacao";
        $regs = DB::select($query);

        $mapa = [];
        $fontes = [];
        $serieAcumulado = [];
        $vetReplace = ['{', '}', '"'];
        $qtd_osc_acumulado = 0;
        foreach ($regs as $reg) {
            //SERIE DE EVOLUÇÃO ANUAL
            $mapa += [$reg->ano_fundacao => $reg->quantidade_oscs];

            //SERIE DO ACUMULADO ANUAL DOS ANOS
            array_push($serieAcumulado, $qtd_osc_acumulado);
            $qtd_osc_acumulado += $reg->quantidade_oscs;

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

        for ($i = $anoi; $i <= $anof; $i++) {
            $ano = array_search($i, $mapa);
            if(!$ano) {
                $mapa += [$i => NULL];
            }
        }

        ksort($mapa);
        $series = array_values($mapa);
        $labels = array_keys($mapa);

        $resultado = ['qtd_osc_por_ano' => [
            'dataLabels' => $labels,
            'series' => [
                [
                    'type' => 'line',
                    'name' => 'Evolução quantidade de OSCs por ano de fundação',
                    'data' => $series],
                [
                    'type' => 'line',
                    'name' => 'Evolução quantidade de OSCs Acumuladas por ano de fundação',
                    'data' => $serieAcumulado
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
		FROM analysis.vw_perfil_localidade_caracteristicas_gerais
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
		FROM analysis.vw_perfil_localidade_qtd_natureza_juridica
		WHERE localidade = " . "'" . $id_localidade . "'";
        $regs = DB::select($query);

        $fontes = [];
        $serie = [];
        $vetReplace = ['{', '}', '"'];
        foreach ($regs as $nat) {
            $serie += [$nat->natureza_juridica => $nat->quantidade_oscs];
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
		FROM analysis.vw_perfil_localidade_maior_qtd_natureza_juridica
		WHERE localidade = " . "'" . $id_localidade . "'";
        $regs = DB::select($query);

        $natureza_juridica = ($regs[0])->natureza_juridica;
        $nr_porcentagem_maior = ($regs[0])->porcertagem_maior;

        $query = "SELECT
            dado,
            valor
		FROM analysis.vw_perfil_localidade_medias_nacional
		WHERE tipo_dado = 'maior_natureza_juridica'";
        $regs = DB::select($query);

        $nr_porcentagem_maior_media_nacional = ($regs[0])->valor;
        $tx_porcentagem_maior_media_nacional = ($regs[0])->dado;

        //JSON RESULTANTE
        $resultado = ['natureza_juridica' => [
            'nr_porcentagem_maior' => $nr_porcentagem_maior,
            'nr_porcentagem_maior_media_nacional' => $nr_porcentagem_maior_media_nacional,
            'tx_porcentagem_maior' => $natureza_juridica,
            'tx_porcentagem_maior_media_nacional' => $tx_porcentagem_maior_media_nacional,
            'series' => $serie,
            'fontes' => $fontes
        ]];

        return $resultado;
    }

    public function getTransferenciasFederais($id_localidade)
    {
        //SERIES PARA GRAFICO PRINCIPAL
        $query = "SELECT
			localidade, 
            natureza_juridica,
            quantidade_oscs,
            fontes
		FROM analysis.vw_perfil_localidade_qtd_natureza_juridica
		WHERE localidade = " . "'" . $id_localidade . "'";
        $regs = DB::select($query);

        $fontes = [];
        $serie = [];
        $vetReplace = ['{', '}', '"'];
        foreach ($regs as $nat) {
            $serie += [$nat->natureza_juridica => $nat->quantidade_oscs];
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
		FROM analysis.vw_perfil_localidade_maior_qtd_natureza_juridica
		WHERE localidade = " . "'" . $id_localidade . "'";
        $regs = DB::select($query);

        $natureza_juridica = ($regs[0])->natureza_juridica;
        $nr_porcentagem_maior = ($regs[0])->porcertagem_maior;

        $query = "SELECT
            dado,
            valor
		FROM analysis.vw_perfil_localidade_medias_nacional
		WHERE tipo_dado = 'maior_natureza_juridica'";
        $regs = DB::select($query);

        $nr_porcentagem_maior_media_nacional = ($regs[0])->valor;
        $tx_porcentagem_maior_media_nacional = ($regs[0])->dado;

        //JSON RESULTANTE
        $resultado = ['natureza_juridica' => [
            'nr_porcentagem_maior' => $nr_porcentagem_maior,
            'nr_porcentagem_maior_media_nacional' => $nr_porcentagem_maior_media_nacional,
            'tx_porcentagem_maior' => $natureza_juridica,
            'tx_porcentagem_maior_media_nacional' => $tx_porcentagem_maior_media_nacional,
            'series' => $serie,
            'fontes' => $fontes
        ]];

        return $resultado;
    }
}