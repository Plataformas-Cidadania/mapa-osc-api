<?php

namespace App\Models\Osc;

use App\Models\Syst\DCMetaProjeto;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_objetivo_osc
 * @property int $id_osc
 * @property int $cd_meta_osc
 * @property string $ft_objetivo_osc
 * @property boolean $bo_oficial
 * @property Osc $osc
 * @property DCMetaProjeto $dc_meta_projeto
 */
class ObjetivoOsc extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'osc.tb_objetivo_osc';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_objetivo_osc';

    /**
     * @var array
     */
    protected $fillable = ['id_osc', 'cd_meta_osc', 'ft_objetivo_osc', 'bo_oficial'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function osc()
    {
        return $this->belongsTo('App\Models\Osc\Osc', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meta_projeto()
    {
        return $this->belongsTo('App\Models\Syst\DCMetaProjeto', 'cd_meta_osc', 'cd_meta_projeto');
    }
}
