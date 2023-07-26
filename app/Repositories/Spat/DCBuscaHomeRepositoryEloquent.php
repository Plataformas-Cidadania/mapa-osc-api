<?php


namespace App\Repositories\Spat;

use App\Repositories\Spat\DCBuscaHomeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DCBuscaHomeRepositoryEloquent implements DCBuscaHomeRepositoryInterface
{
    //private $model;

    public function __construct()
    {
        //$this->model = $_modelo;
    }

    public function getListaMunicipios($texto_busca)
    {
        $vetReplace = ['_', '-', '%20'];
        $texto_busca = str_replace($vetReplace, '', $texto_busca);

        //dd($texto_busca);

        $query = "SELECT
                    edmu_cd_municipio, edmu_nm_municipio, eduf_sg_uf
                FROM spat.vw_municipios_estados
                WHERE edmu_nm_municipio_ajustado ILIKE " . "'" . $texto_busca . "%'"
        . "ORDER BY edmu_nm_municipio";
        $regs = DB::select($query);

        return $regs;
    }

    public function getListaEstados($texto_busca)
    {
        $vetReplace = ['_', '-', '%20'];
        $texto_busca = str_replace($vetReplace, '', $texto_busca);

        //dd($texto_busca);

        $query = "SELECT
                    eduf_cd_uf, eduf_nm_uf
                FROM spat.vw_estado
                WHERE eduf_nm_uf_ajustado ILIKE " . "'" . $texto_busca . "%'"
        . "ORDER BY eduf_nm_uf";
        $regs = DB::select($query);

        return $regs;
    }

    public function getListaRegioes($texto_busca)
    {
        $vetReplace = ['_', '-', '%20'];
        $texto_busca = str_replace($vetReplace, '', $texto_busca);

        //dd($texto_busca);

        $query = "SELECT
                    edre_cd_regiao, edre_nm_regiao
                FROM spat.vw_regiao
                WHERE edre_nm_regiao_ajustado ILIKE " . "'" . $texto_busca . "%'"
        . "ORDER BY edre_nm_regiao";
        $regs = DB::select($query);

        return $regs;
    }

    public function getListaTodasLocalizacoes($texto_busca)
    {
        $vetReplace = ['_', '-', '%20'];
        $texto_busca = str_replace($vetReplace, '', $texto_busca);

        //dd($texto_busca);

        $query1 = "SELECT eduf_cd_uf, eduf_nm_uf
               FROM spat.vw_estado
               WHERE eduf_nm_uf_ajustado ILIKE '" . $texto_busca . "%'
               ORDER BY eduf_nm_uf";

        $query2 = "SELECT edre_cd_regiao, edre_nm_regiao
               FROM spat.vw_regiao
               WHERE edre_nm_regiao_ajustado ILIKE '" . $texto_busca . "%'
               ORDER BY edre_nm_regiao";

        $query3 = "SELECT edmu_cd_municipio, edmu_nm_municipio, eduf_sg_uf
               FROM spat.vw_municipios_estados
               WHERE edmu_nm_municipio_ajustado ILIKE '" . $texto_busca . "%'
               ORDER BY edmu_nm_municipio";

        $results1 = DB::select($query1);
        $results2 = DB::select($query2);
        $results3 = DB::select($query3);

        // Merge the results arrays
        $mergedResults = array_merge($results1, $results2, $results3);

        return $mergedResults;
    }

}