<?php

namespace App\Models\Syst;

use App\Models\Osc\ParticipacaoSocialConselho;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_tipo_participacao
 * @property string $tx_nome_tipo_participacao
 * @property ParticipacaoSocialConselho $participacao_social_conselhos
 * 
 * @OA\Schema(
 *   schema="DCTipoParticipacao",
 *   description="Objeto do tipo de participação "
 * )
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
     * @OA\Property(
     *     property="cd_tipo_participacao",
     *     type="integer",
     *     description="Número de identificação do tipo de participação"
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_tipo_participacao';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_tipo_participacao",
         *     type="string",
         *     description="Nome do tipo de participação"
         *   )
         */
        'tx_nome_tipo_participacao'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participacao_social_conselhos()
    {
        return $this->hasMany('App\Models\Osc\ParticipacaoSocialConselho', 'cd_tipo_participacao', 'cd_tipo_participacao');
    }
}
