<?php

namespace App\Models\Syst;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_status_projeto
 * @property string $tx_nome_status_projeto
 * @property Osc.tbQuadroSocietario[] $osc.tbQuadrosSocietarios
 * 
 * @OA\Schema(
 *   schema="DCQualificacaoSocio",
 *   description="Qualificação de sócio."
 * )
 */
class DCQualificacaoSocio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_qualificacao_socio';

    /**
     * @OA\Property(
     *     property="cd_qualificacao_socio",
     *     type="integer",
     *     description="Número da qualificação de sócio."
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_qualificacao_socio';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_qualificacao_socio",
         *     type="string",
         *     description="Nome da qualificação de sócio."
         *   )
         */
        'tx_qualificacao_socio'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quadros_societarios()
    {
        return $this->hasMany('App\Models\Osc\QuadroSocietario', 'cd_qualificacao_socio', 'cd_qualificacao_socio');
    }
}
