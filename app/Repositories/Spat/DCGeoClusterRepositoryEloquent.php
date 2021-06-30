<?php


namespace App\Repositories\Spat;

use App\Models\Spat\DCGeoCluster;
use App\Repositories\Spat\DCGeoClusterRepositoryInterface;
use App\Util\TratarString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DCGeoClusterRepositoryEloquent implements DCGeoClusterRepositoryInterface
{
    private $model;

    public function __construct(DCGeoCluster $_modelo)
    {
        $this->model = $_modelo;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getMunicipiosPorEstado($id_estado)
    {
        $query = "SELECT
			id_regiao,
            cd_tipo_regiao,
            tx_tipo_regiao,
            tx_nome_regiao,
            tx_sigla_regiao,
            geo_lat_centroid_regiao,
            geo_lng_centroid_regiao,
            nr_quantidade_osc_regiao
		FROM spat.vw_geo_cluster_regiao
		WHERE id_regiao IN (
			SELECT edmu_cd_municipio FROM spat.ed_municipio WHERE eduf_cd_uf = " . $id_estado . "
        )";

        $regs = DB::select($query);

        return $regs;
    }

    public function getEstadosPorRegiao($id_regiao)
    {
        $query = "SELECT
			id_regiao,
            cd_tipo_regiao,
            tx_tipo_regiao,
            tx_nome_regiao,
            tx_sigla_regiao,
            geo_lat_centroid_regiao,
            geo_lng_centroid_regiao,
            nr_quantidade_osc_regiao
		FROM spat.vw_geo_cluster_regiao
		WHERE id_regiao IN (
			SELECT eduf_cd_uf FROM spat.ed_uf WHERE edre_cd_regiao = " . $id_regiao . "
        )";

        $regs = DB::select($query);

        return $regs;
    }

    public function getOSCsPorEstado($id_regiao)
    {
        $query = "SELECT
			id_osc,
            tx_apelido_osc,
            geo_lat,
            geo_lng,
            geo_centroid_municipio
		FROM osc.vw_geo_osc
		WHERE cd_estado = " . $id_regiao;

        $regs = DB::select($query);

        return $regs;
    }

    public function getOSCsPorMunicipio($id_regiao)
    {
        $query = "SELECT
			id_osc,
            tx_apelido_osc,
            geo_lat,
            geo_lng,
            geo_centroid_municipio
		FROM osc.vw_geo_osc
		WHERE cd_municipio = " . $id_regiao;

        $regs = DB::select($query);

        return $regs;
    }

    public function getOSCsPorRazaoSocial($tx_parametro)
    {
        $tx_parametro = strtolower($tx_parametro);

        $tx_parametro_cnpj = trim($tx_parametro, '0');
        $tx_parametro = str_replace('_', ' ', $tx_parametro);

        //dd($tx_parametro);

        //$tx_parametro = TratarString::removerAcentos($tx_parametro);


        $query = "SELECT 
			vw_busca_resultado.id_osc, 
			vw_busca_resultado.geo_lat, 
			vw_busca_resultado.geo_lng 
		FROM 
			osc.vw_busca_resultado 
		WHERE 
			vw_busca_resultado.id_osc IN 
			(
                SELECT vw_busca_osc.id_osc 
                FROM osc.vw_busca_osc 
                WHERE vw_busca_osc.cd_identificador_osc::TEXT = '" . $tx_parametro_cnpj . "'
                            OR
                            (
                                LOWER(UNACCENT(vw_busca_osc.tx_razao_social_osc)) = '" . $tx_parametro . "'
                                OR
                                LOWER(UNACCENT(vw_busca_osc.tx_nome_fantasia_osc)) = '" . $tx_parametro . "'
                            )
                ORDER BY GREATEST(
                    similarity(vw_busca_osc.cd_identificador_osc::TEXT, '" . $tx_parametro_cnpj . "'), 
                    similarity(vw_busca_osc.tx_razao_social_osc::TEXT, '" . $tx_parametro . "'), 
                    similarity(vw_busca_osc.tx_nome_fantasia_osc::TEXT, '" . $tx_parametro . "')
                ) DESC, vw_busca_osc.tx_nome_osc ASC LIMIT 1
			)";

        $regs = DB::select($query);

        return $regs;
    }

    public function get($_id)
    {
        $geocluster = $this->model->find($_id);

        return $geocluster;
    }

    public function getRegiaoAll()
    {
        $geoclusters = $this->model->all()->where('cd_tipo_regiao', 1);

        return $geoclusters;
    }

    public function getEstadoAll()
    {
        $geoclusters = $this->model->all()->where('cd_tipo_regiao', 2);

        return $geoclusters;
    }
}