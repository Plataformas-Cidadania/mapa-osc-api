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
}