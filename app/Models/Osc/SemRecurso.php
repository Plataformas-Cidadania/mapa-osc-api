<?php

namespace App\Models\Osc;

use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id_osc
 * @property int $ano
 * @property string $ft_nao_possui
 * @property dcOrigemFonteRecursoOsc $syst.dcOrigemFonteRecursoOsc
 */
class SemRecurso extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'osc.tb_n_recurso_osc_ano';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_osc';


    /**
     * @var array
     */
    protected $fillable = [
        'id_osc',
        'ano',
        'cd_origem_fonte_recursos_osc',
        'ft_nao_possui'
    ];

    protected $attributes = [
        'ft_nao_possui' => 'Representante de OSC'
    ];

    public $timestamps = false;

    protected $with = ['dc_origem_fonte_recurso'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dc_origem_fonte_recurso()
    {
        return $this->hasOne('App\Models\Syst\DCOrigemFonteRecursosOsc', 'cd_origem_fonte_recursos_osc', 'cd_origem_fonte_recursos_osc');
    }
 
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function osc()
    {
        return $this->belongsTo('App\Models\Osc\Osc', 'id_osc', 'id_osc'); 

    }    
}
