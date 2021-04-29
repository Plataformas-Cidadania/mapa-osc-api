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
class DCIpeadataUff extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ipeadata.vw_dados_geograficos_idh_uf';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'eduf_cd_uf';

    /**
     * @var array
     */
    protected $fillable = ['eduf_nm_uf', 'edre_cd_regiao', 'eduf_geometry', 'nr_valor'];

    public $timestamps = false;
}
