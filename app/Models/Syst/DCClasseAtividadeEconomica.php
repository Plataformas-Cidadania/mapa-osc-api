<?php

namespace App\Models\Syst;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $cd_classe_atividade_economica
 * @property string $tx_nome_classe_atividade_economica
 * @property SubclasseAtividadeEconomica[] $DCSubclasseAtividadeEconomicas
 * 
 * @OA\Schema(
 *   schema="DCClasseAtividadeEconomica",
 *   description="Objeto da classe de atividade econômica"
 * )
 */
class DCClasseAtividadeEconomica extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_classe_atividade_economica';

    /**
     * @OA\Property(
     *     property="cd_classe_atividade_economica",
     *     type="integer",
     *     description="Número da classe de atividade econômica."
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_classe_atividade_economica';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_classe_atividade_economica",
         *     type="string",
         *     description="Nome da classe de atividade econômica."
         *   )
         */
        'tx_nome_classe_atividade_economica'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subclasse_atividades_economicas()
    {
        return $this->hasMany('App\Models\Syst\SubclasseAtividadeEconomica', 'cd_classe_atividade_economica', 'cd_classe_atividade_economica');
    }
}
