<?php

namespace App\Models\Osc;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_recursos_osc
 * @property int $id_osc
 * @property int $cd_fonte_recursos_osc
 * @property string $ft_fonte_recursos_osc
 * @property string $dt_ano_recursos_osc
 * @property string $ft_ano_recursos_osc
 * @property float $nr_valor_recursos_osc
 * @property string $ft_valor_recursos_osc
 * @property Syst.dcFonteRecursosOsc $syst.dcFonteRecursosOsc
 * @property Osc.tbOsc $osc.tbOsc
 */
class Recurso extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'osc.tb_recursos_osc';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_recursos_osc';

    /**
     * @var array
     */
    protected $fillable = [
        'id_osc',
        'cd_fonte_recursos_osc',
        'ft_fonte_recursos_osc',
        'dt_ano_recursos_osc',
        'ft_ano_recursos_osc',
        'nr_valor_recursos_osc',
        'ft_valor_recursos_osc'
    ];

    protected $attributes = [
        'ft_fonte_recursos_osc' => 'Representante de OSC',
        'ft_ano_recursos_osc' => 'Representante de OSC',
        'ft_valor_recursos_osc' => 'Representante de OSC'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dc_fonte_recurso()
    {
        return $this->hasOne('App\Models\Syst\DCFonteRecursosOsc', 'cd_fonte_recursos_osc', 'cd_fonte_recursos_osc');
    }
 
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function osc()
    {
        return $this->belongsTo('App\Models\Osc\Osc', 'id_osc', 'id_osc');
    }    
}
