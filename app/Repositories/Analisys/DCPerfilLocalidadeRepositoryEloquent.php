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
            'type' => 'line',
            'dataLabels' => $labels,
            'series' => [
                [
                'name' => 'Evolução quantidade de OSCs por ano de fundação',
                'data' => $series],
                [
                'name' => 'Evolução quantidade de OSCs Acumuladas por ano de fundação',
                'data' => $serieAcumulado
                ],
            ],
            'fontes' => $fontes
        ]];

        return $resultado;
    }
}