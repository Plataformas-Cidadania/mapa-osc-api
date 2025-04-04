<?php

namespace App\Models\Osc;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_osc_parceira_projeto
 * @property int $id_osc
 * @property int $id_projeto
 * @property string $ft_osc_parceira_projeto
 * @property boolean $bo_oficial
 * @property Osc $osc
 * @property Projeto $projeto
 */
class OscParceiraProjeto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'osc.tb_osc_parceira_projeto';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_osc_parceira_projeto';

    /**
     * @var array
     */
    protected $fillable = [
        'id_osc',
        'id_projeto',
        'ft_osc_parceira_projeto',
        'bo_oficial'
    ];

    protected $attributes = [
        'ft_osc_parceira_projeto' => 'Representante de OSC',
    ];

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
    public function projeto()
    {
        return $this->belongsTo('App\Models\Osc\Projeto', 'id_projeto', 'id_projeto');
    }
}
