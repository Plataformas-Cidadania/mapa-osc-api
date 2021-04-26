<?php

namespace App\Models\Spat;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $id_regiao
 * @property integer $cd_tipo_regiao
 * @property string $tx_tipo_regiao
 * @property string $tx_nome_regiao
 * @property string $tx_sigla_regiao
 * @property mixed $geo_lat_centroid_regiao
 * @property mixed $geo_lng_centroid_regiao
 * @property string $nr_quantidade_osc_regiao
 */
class DCGeoCluster extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'spat.vw_geo_cluster_regiao';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_regiao';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'float';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = ['cd_tipo_regiao', 'tx_tipo_regiao', 'tx_nome_regiao', 'tx_sigla_regiao', 'geo_lat_centroid_regiao', 'geo_lng_centroid_regiao', 'nr_quantidade_osc_regiao'];

    public $timestamps = false;
}
