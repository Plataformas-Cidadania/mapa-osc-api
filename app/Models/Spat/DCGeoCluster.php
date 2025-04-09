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
 *
 * @OA\Schema(
 *   schema="DCGeoCluster",
 *   description="Descrição ",
 * )
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
     *   @OA\Property(
     *     property="id_regiao",
     *     type="integer",
     *     description="Número de identificação da região"
     *   )
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
    protected $fillable = [
        /**
         *   @OA\Property(
         *     property="cd_tipo_regiao",
         *     type="string",
         *     description="Identificação do tipo da região."
         *   )
         */
        'cd_tipo_regiao',
        
        /**
         *   @OA\Property(
         *     property="tx_tipo_regiao",
         *     type="string",
         *     description="Texto do tipo da região."
         *   )
         */
        'tx_tipo_regiao',
        
        /**
         *   @OA\Property(
         *     property="tx_nome_regiao",
         *     type="string",
         *     description="Texto do nome da região."
         *   )
         */
        'tx_nome_regiao',
        
        /**
         *   @OA\Property(
         *     property="tx_sigla_regiao",
         *     type="string",
         *     description="Texto da sigla da região."
         *   )
         */
        'tx_sigla_regiao',
        
        /**
         *   @OA\Property(
         *     property="geo_lat_centroid_regiao",
         *     type="string",
         *     description="Latitude da região."
         *   )
         */
        'geo_lat_centroid_regiao',
        
        /**
         *   @OA\Property(
         *     property="geo_lng_centroid_regiao",
         *     type="string",
         *     description="Longitude da região."
         *   )
         */
        'geo_lng_centroid_regiao',
        
        /**
         *   @OA\Property(
         *     property="nr_quantidade_osc_regiao",
         *     type="string",
         *     description="Quantidade de OSC na região."
         *   )
         */
        'nr_quantidade_osc_regiao'];

    public $timestamps = false;
}
