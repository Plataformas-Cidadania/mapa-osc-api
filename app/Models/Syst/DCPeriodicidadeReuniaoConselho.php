<?php

namespace App\Models\Syst;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_periodicidade_reuniao_conselho
 * @property string $tx_nome_periodicidade_reuniao_conselho
 * @property Osc.tbParticipacaoSocialConselho[] $osc.tbParticipacaoSocialConselhos
 * 
 * @OA\Schema(
 *   schema="DCPeriodicidadeReuniaoConselho",
 *   description="Periodicidade Reunião do Conselho"
 * )
 */
class DCPeriodicidadeReuniaoConselho extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_periodicidade_reuniao_conselho';

    /**
     * @OA\Property(
     *     property="cd_periodicidade_reuniao_conselho",
     *     type="integer",
     *     description="Número de periodicidade reunião do conselho"
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_periodicidade_reuniao_conselho';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_periodicidade_reuniao_conselho",
         *     type="string",
         *     description="Nome da periodicidade reunião do conselho"
         *   )
         */
        'tx_nome_periodicidade_reuniao_conselho'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ParticipacaoSocialConselhos()
    {
        return $this->hasMany('App\Models\Osc\ParticipacaoSocialConselho', 'cd_periodicidade_reuniao_conselho', 'cd_periodicidade_reuniao_conselho');
    }
}
