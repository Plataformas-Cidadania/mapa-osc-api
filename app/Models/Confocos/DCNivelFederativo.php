<?php

namespace App\Models\Confocos;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_nivel_federativo
 * @property string $tx_nome_nivel_federativo

 * 
 * @OA\Schema(
 *   schema="DCNivelFederativo",
 *   description="Objeto do Nível Federativo do Conselho (Confocos). "
 * )
 */
class DCNivelFederativo extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_nivel_federativo';

    /**
     * @OA\Property(
     *     property="cd_nivel_federativo",
     *     type="integer",
     *     description="Número de identificação do Nível Federativo."
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_nivel_federativo';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_nivel_federativo",
         *     type="string",
         *     description="Nome do Nível Federativo."
         *   )
         */
        'tx_nome_nivel_federativo',
    ];

    /**
     * @var desativar coluna BD
     */
    public $timestamps = false;
}
