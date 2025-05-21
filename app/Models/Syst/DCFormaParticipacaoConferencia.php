<?php

namespace App\Models\Syst;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_forma_participacao_conferencia
 * @property string $tx_nome_forma_participacao_conferencia
 * @property Osc.tbParticipacaoSocialConferencium[] $osc.tbParticipacaoSocialConferencias
 * 
 * @OA\Schema(
 *   schema="DCFormaParticipacaoConferencia",
 *   description="Forma de participação da conferência."
 * )
 */
class DCFormaParticipacaoConferencia extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_forma_participacao_conferencia';

    /**
     * @OA\Property(
     *     property="cd_forma_participacao_conferencia",
     *     type="integer",
     *     description="Número de identificação da forma de participação da conferência."
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_forma_participacao_conferencia';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_forma_participacao_conferencia",
         *     type="string",
         *     description="Nome da forma de participação da conferência."
         *   )
         */
        'tx_nome_forma_participacao_conferencia'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participacao_social_conferencias()
    {
        return $this->hasMany('App\Models\Osc\ParticipacaoSocialConferencium', 'cd_forma_participacao_conferencia', 'cd_forma_participacao_conferencia');
    }
}
