<?php


namespace App\Repositories\Spat;

use App\Models\Spat\DCGeoCluster;
use App\Repositories\Spat\DCGeoClusterRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

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

    public function get($_id)
    {
        $meta = $this->model->find($_id);

        return $meta;
    }

    public function getRegiaoAll()
    {
        $meta = $this->model->all()->where('cd_tipo_regiao', 1);

        return $meta;
    }

    public function getEstadoAll()
    {
        $meta = $this->model->all()->where('cd_tipo_regiao', 2);

        return $meta;
    }
}