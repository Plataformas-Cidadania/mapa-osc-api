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
        $sql = $query = "SELECT
			localidade, ano_fundacao, quantidade_oscs, fontes
		FROM analysis.vw_perfil_localidade_evolucao_qtd_osc_por_ano
		WHERE localidade = " . "'" . $id_localidade . "'"
        . "ORDER BY ano_fundacao";
        $series = DB::select($sql);

        //FONTES do Gráfico
        $queryFontes = "SELECT
			fontes
		FROM analysis.vw_perfil_localidade_evolucao_qtd_osc_por_ano
		WHERE localidade = " . "'" . $id_localidade . "'"
            . "GROUP BY fontes";

        $resultadoFontes = DB::select($queryFontes);
        $vetFontes = array_values($resultadoFontes);
        $vetReplace = ['{', '}', '"'];
        $fontes = [];
        foreach ($vetFontes as $valor) {
            $valorSemChaves = str_replace($vetReplace, '', $valor->fontes);
            $vet = explode(',', $valorSemChaves);
            //strcmp($f, 'Representante de OSC')
            foreach ($vet as $f) {
                if (!array_search($f, $fontes)) {
                    array_push($fontes, $f);
                }
            }
        }

        $mapa = [];
        foreach ($series as $serie) {
            $mapa += [$serie->ano_fundacao => $serie->quantidade_oscs];
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
            'labels' => $labels,
            'series' => [
                'name' => 'Evolução quantidade de OSCs por ano de fundação',
                'type' => 'line',
                'data' => $series
                ],
            'fontes' => $fontes
        ]];
        return $resultado;
    }
}