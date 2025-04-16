<?php

namespace App\Models\Syst;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_situacao_cadastral
 * @property string $tx_nome_situacao_cadastral
 * 
 * @OA\Schema(
 *   schema="DCSituacaoCadastral",
 *   description="Objeto da area de atuação. "
 * )
 */
class DCSituacaoCadastral extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_situacao_cadastral';

    /**
     * @OA\Property(
     *     property="cd_situacao_cadastral",
     *     type="integer",
     *     description="Número de identificação da siatuação cadastral."
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_situacao_cadastral';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_situacao_cadastral",
         *     type="string",
         *     description="Nome da situação cadastral."
         *   )
         */
        'tx_nome_situacao_cadastral'
    ];

}
