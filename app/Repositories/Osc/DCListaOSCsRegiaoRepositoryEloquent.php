<?php


namespace App\Repositories\OSC;

use App\Repositories\OSC\DCListaOSCsRegiaoRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DCListaOSCsRegiaoRepositoryEloquent implements DCListaOSCsRegiaoRepositoryInterface
{
    //private $model;

    public function __construct()
    {
        //$this->model = $_modelo;
    }

    public function getListaOSCsMunicipio($id_localidade)
    {
        $query = "SELECT
			id_osc,
			tx_nome_osc,
			cd_identificador_osc,
			tx_natureza_juridica_osc,
			tx_endereco_osc,
			geo_lat,
			geo_lng,
			tx_nome_atividade_economica,
			im_logo
		FROM osc.vw_busca_resultado
		WHERE vw_busca_resultado.id_osc IN (
			SELECT a.id_osc FROM (
                SELECT 
                    vw_busca_osc_geo.id_osc 
                FROM 
                    osc.vw_busca_osc_geo 
                WHERE 
                    vw_busca_osc_geo.cd_municipio = " . $id_localidade . "
            ) a
        )";

        $regs = DB::select($query);

        return $regs;
    }

    public function getListaOSCsEstado($id_localidade)//PAINEL PRINCIPAL DE OSCs da Página Perfil Localidade
    {
        $query = "SELECT
			id_osc,
			tx_nome_osc,
			cd_identificador_osc,
			tx_natureza_juridica_osc,
			tx_endereco_osc,
			geo_lat,
			geo_lng,
			tx_nome_atividade_economica,
			im_logo
		FROM osc.vw_busca_resultado
		WHERE vw_busca_resultado.id_osc IN (
			SELECT a.id_osc FROM (
                SELECT 
                    vw_busca_osc_geo.id_osc 
                FROM 
                    osc.vw_busca_osc_geo 
                WHERE 
                    vw_busca_osc_geo.cd_estado = " . $id_localidade . "
            ) a
        )";

        $regs = DB::select($query);

        return $regs;
    }

    public function getListaOSCsRegiao($id_localidade)
    {
        $query = "SELECT
			id_osc,
			tx_nome_osc,
			cd_identificador_osc,
			tx_natureza_juridica_osc,
			tx_endereco_osc,
			geo_lat,
			geo_lng,
			tx_nome_atividade_economica,
			im_logo
		FROM osc.vw_busca_resultado
		WHERE vw_busca_resultado.id_osc IN (
			SELECT a.id_osc FROM (
                SELECT 
                    vw_busca_osc_geo.id_osc 
                FROM 
                    osc.vw_busca_osc_geo 
                WHERE 
                    vw_busca_osc_geo.cd_regiao = " . $id_localidade . "
            ) a
        )";

        $regs = DB::select($query);

        return $regs;
    }
}