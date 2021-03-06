<?php


namespace App\Repositories\Spat;

use App\Models\Spat\DCGeoCluster;
use Illuminate\Database\Eloquent\Model;

interface DCGeoClusterRepositoryInterface
{
    public function __construct(DCGeoCluster $_modelo);

    public function getAll();

    public function getMunicipiosPorEstado($id_estado);

    public function getEstadosPorRegiao($id_regiao);

    public function getOSCsPorEstado($id_regiao);

    public function getOSCsPorMunicipio($id_regiao);

    public function getOSCsPorRazaoSocial($tx_parametro);

    public function get($_id);

    public function getRegiaoAll();

    public function getEstadoAll();
}