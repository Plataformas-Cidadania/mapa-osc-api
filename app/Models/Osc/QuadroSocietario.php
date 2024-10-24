<?php

namespace App\Models\Osc;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_dirigente
 * @property int $id_osc
 * @property string $tx_cargo_dirigente
 * @property string $ft_cargo_dirigente
 * @property string $tx_nome_dirigente
 * @property string $ft_nome_dirigente
 * @property boolean $bo_oficial
 * @property Osc.tbOsc $osc.tbOsc
 */
class QuadroSocietario extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'osc.tb_quadro_societario';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_quadro_societario';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id_quadro_societario',
        'id_osc',
        'tx_nome_socio',
        'ft_nome_socio',
        'tx_cpf_socio',
        'ft_cpf_socio',
        'tx_data_entrada_socio',
        'ft_data_entrada_socio',
        'cd_qualificacao_socio',
        'ft_qualificacao_socio',
        'cd_tipo_socio',
        'ft_tipo_socio',
        'bo_oficial'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function osc()
    {
        return $this->belongsTo('App\Models\Osc\Osc', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function qualificacaoSocio()
    {
        return $this->hasOne('App\Models\Syst\DCQualificacaoSocio', 'cd_qualificacao_socio', 'cd_qualificacao_socio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipoSocio()
    {
        return $this->hasOne('App\Models\Syst\DCTipoSocio', 'cd_tipo_socio', 'cd_tipo_socio');
    }
}
