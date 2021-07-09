<?php

namespace App\Models\Syst;

use App\Models\Osc\ParticipacaoSocialConselho;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_tipo_participacao
 * @property string $tx_nome_tipo_participacao
 * @property ParticipacaoSocialConselho $participacao_social_conselhos
 */
class DCTipoParticipacao extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_tipo_participacao';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_tipo_participacao';

    /**
     * @var array
     */
    protected $fillable = ['tx_nome_tipo_participacao'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participacao_social_conselhos()
    {
        return $this->hasMany('App\Models\Osc\ParticipacaoSocialConselho', 'cd_tipo_participacao', 'cd_tipo_participacao');
    }
}
