<?php

namespace App\Models\Syst;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_conselho
 * @property string $tx_nome_conselho
 * @property string $tx_nome_orgao_vinculado
 * @property Osc.tbParticipacaoSocialConselho[] $osc.tbParticipacaoSocialConselhos
 * 
 * @OA\Schema(
 *   schema="DCConselho",
 *   description="Conselho"
 * )
 */
class DCConselho extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_conselho';

    /**
     * @OA\Property(
     *     property="cd_conselho",
     *     type="integer",
     *     description="Número de identificação do conselho"
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_conselho';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_conselho",
         *     type="string",
         *     description="Nome do conselho"
         *   )
         */
        'tx_nome_conselho', 
        
        /**
         * @OA\Property(
         *     property="tx_nome_orgao_vinculado",
         *     type="string",
         *     description="Nome do orgão vinculado"
         *   )
         */
        'tx_nome_orgao_vinculado'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ParticipacaoSocialConselhos()
    {
        return $this->hasMany('App\Models\Osc\ParticipacaoSocialConselho', 'cd_conselho', 'cd_conselho');
    }
}
