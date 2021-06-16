<?php

namespace App\Models\Ipeadata;

use Illuminate\Database\Eloquent\Model;

/**
 * @property float $eduf_cd_uf
 * @property string $eduf_nm_uf
 * @property mixed $edre_cd_regiao
 * @property int $eduf_geometry
 * @property float $nr_valor
 */
class DCIpeadataMunicipio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ipeadata.vw_dados_geograficos_idh_municipio';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'edmu_cd_municipio';

    /**
     * @var array
     */
    protected $fillable = ['edmu_nm_municipio', 'eduf_cd_uf', 'edmu_geometry', 'edmu_centroid', 'edmu_bounding_box', 'nr_valor'];

    public $timestamps = false;
}
