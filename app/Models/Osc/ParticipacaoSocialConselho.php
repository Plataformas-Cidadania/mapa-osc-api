<?php

namespace App\Models\Osc;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_conselho
 * @property int $id_osc
 * @property int $cd_conselho
// * @property int $cd_tipo_participacao
 * @property int $cd_periodicidade_reuniao_conselho
 * @property string $ft_conselho
 * @property string $ft_tipo_participacao
 * @property string $ft_periodicidade_reuniao
 * @property string $dt_data_inicio_conselho
 * @property string $ft_data_inicio_conselho
 * @property string $dt_data_fim_conselho
 * @property string $ft_data_fim_conselho
 * @property boolean $bo_oficial
 * @property DCConselho $dc_conselho
 * @property Syst.dcPeriodicidadeReuniaoConselho $syst.dcPeriodicidadeReuniaoConselho
 * @property Syst.dcTipoParticipacao $syst.dcTipoParticipacao
 * @property Osc.tbOsc $osc.tbOsc
 * @property Osc.tbParticipacaoSocialConselhoOutro[] $osc.tbParticipacaoSocialConselhoOutros
 * @property Osc.tbRepresentanteConselho[] $osc.tbRepresentanteConselhos
 */
class ParticipacaoSocialConselho extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'osc.tb_participacao_social_conselho';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_conselho';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id_osc',
        'cd_conselho',
        'cd_periodicidade_reuniao_conselho',
        'ft_conselho',
        'ft_tipo_participacao',
        'ft_periodicidade_reuniao',
        'dt_data_inicio_conselho',
        'ft_data_inicio_conselho',
        'dt_data_fim_conselho',
        'ft_data_fim_conselho',
        'bo_oficial'
    ];

    protected $attributes = [
        'ft_conselho' => 'Representante de OSC',
        'ft_tipo_participacao' => 'Representante de OSC',
        'ft_periodicidade_reuniao' => 'Representante de OSC',
        'ft_data_inicio_conselho' => 'Representante de OSC',
        'ft_data_fim_conselho' => 'Representante de OSC'
    ];

    protected $with = ['dc_conselho', 'dc_periodicidade_reuniao_conselho'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dc_conselho()
    {
        return $this->belongsTo('App\Models\Syst\DCConselho', 'cd_conselho', 'cd_conselho');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dc_periodicidade_reuniao_conselho()
    {
        return $this->belongsTo('App\Models\Syst\DCPeriodicidadeReuniaoConselho', 'cd_periodicidade_reuniao_conselho', 'cd_periodicidade_reuniao_conselho');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function osc()
    {
        return $this->belongsTo('App\Models\Osc\Osc', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ParticipacaoSocialConselhoOutros()
    {
        return $this->hasMany('App\Models\Osc\ParticipacaoSocialConselhoOutro', 'id_conselho', 'id_conselho');
    }
}
