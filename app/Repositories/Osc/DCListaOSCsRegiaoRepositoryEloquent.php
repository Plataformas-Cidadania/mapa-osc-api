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

    public function getListaOSCsTotal($pagina)
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
                    vw_busca_osc.id_osc 
                FROM 
                    osc.vw_busca_osc 
               LIMIT 10 OFFSET " . $pagina . "
            ) a
        )";

        $regs = DB::select($query);

        $query = "SELECT
			COUNT (*)
		FROM osc.vw_busca_resultado
		WHERE vw_busca_resultado.id_osc IN (
			SELECT a.id_osc FROM (
                SELECT 
                    vw_busca_osc.id_osc 
                FROM 
                    osc.vw_busca_osc
            ) a
        )";

        $total = DB::select($query);

        $resultado = [
            "total" => $total[0]->count,
            "lista" => $regs
        ];

        return $resultado;
    }

    public function getListaOSCsMunicipio($id_localidade, $pagina)
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
                    vw_busca_osc_geo.cd_municipio = " . $id_localidade . " LIMIT 10 OFFSET " . $pagina . "
            ) a
        )";

        $regs = DB::select($query);

        $query = "SELECT
			COUNT (*)
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

        $total = DB::select($query);

        $resultado = [
            "total" => $total[0]->count,
            "lista" => $regs
        ];

        return $resultado;
    }

    public function getListaOSCsEstado($id_localidade, $pagina)//PAINEL PRINCIPAL DE OSCs da Página Perfil Localidade
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
                    vw_busca_osc_geo.cd_estado = " . $id_localidade . " LIMIT 10 OFFSET " . $pagina . "
            ) a
        )";

        $regs = DB::select($query);

        $query = "SELECT
			COUNT (*)
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

        $total = DB::select($query);

        $resultado = [
            "total" => $total[0]->count,
            "lista" => $regs
        ];

        return $resultado;
    }

    public function getListaOSCsRegiao($id_localidade, $pagina)
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
                    vw_busca_osc_geo.cd_regiao = " . $id_localidade . " LIMIT 10 OFFSET " . $pagina . "
            ) a
        )";

        $regs = DB::select($query);

        $query = "SELECT
			COUNT (*)
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

        $total = DB::select($query);

        $resultado = [
            "total" => $total[0]->count,
            "lista" => $regs
        ];

        return $resultado;
    }
}