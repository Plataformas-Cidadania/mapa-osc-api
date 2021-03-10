<?php

namespace App\Models\Osc;

use App\Models\Syst\DCAreaAtuacao;
use App\Models\Syst\DCSubareaAtuacao;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_area_atuacao
 * @property int $id_osc
 * @property int $cd_area_atuacao
 * @property int $cd_subarea_atuacao
 * @property string $ft_area_atuacao
 * @property boolean $bo_oficial
 * @property string $tx_nome_outra
 * @property DCAreaAtuacao $dc_area_atuacao
 * @property DCSubareaAtuacao $dc_subarea_atuacao
 * @property Osc $osc
 */
class AreaAtuacao extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'osc.tb_area_atuacao';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_area_atuacao';

    /**
     * @var array
     */
    protected $fillable = ['id_osc', 'cd_area_atuacao', 'cd_subarea_atuacao', 'ft_area_atuacao', 'bo_oficial', 'tx_nome_outra'];

    public $timestamps = false;

    protected $with = ['dc_area_atuacao', 'dc_subarea_atuacao'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dc_area_atuacao()
    {
        return $this->belongsTo('App\Models\Syst\DCAreaAtuacao', 'cd_area_atuacao', 'cd_area_atuacao');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dc_subarea_atuacao()
    {
        return $this->belongsTo('App\Models\Syst\DCSubareaAtuacao', 'cd_subarea_atuacao', 'cd_subarea_atuacao');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function osc()
    {
        return $this->belongsTo('App\Models\Osc\Osc', 'id_osc', 'id_osc');
    }
}
