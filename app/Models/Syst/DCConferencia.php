<?php

namespace App\Models\Syst;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_conferencia
 * @property string $tx_nome_conferencia
 * @property Osc.tbParticipacaoSocialConferencium[] $osc.tbParticipacaoSocialConferencias
 * 
 * @OA\Schema(
 *   schema="DCConferencia",
 *   description="Conferência"
 * )
 */
class DCConferencia extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_conferencia';

    /**
     * @OA\Property(
     *     property="cd_conferencia",
     *     type="integer",
     *     description="Número de identificação da conferência."
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_conferencia';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_conferencia",
         *     type="string",
         *     description="Nome da conferência."
         *   )
         */
        'tx_nome_conferencia'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participacao_social_conferencias()
    {
        return $this->hasMany('App\Models\Osc\ParticipacaoSocialConferencia', 'cd_conferencia', 'cd_conferencia');
    }
}
