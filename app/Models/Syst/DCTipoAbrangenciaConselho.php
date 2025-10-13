<?php

namespace App\Models\Syst;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_tipo_abrangencia
 * @property string $tx_nome_abrangencia

 * 
 * @OA\Schema(
 *   schema="DCTipoAbrangenciaConselho",
 *   description="Objeto do Tipo de Abrangência do Conselho (Confocos). "
 * )
 */
class DCTipoAbrangenciaConselho extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_abrangencia_conselho';

    /**
     * @OA\Property(
     *     property="cd_tipo_abrangencia",
     *     type="integer",
     *     description="Número de identificação do Tipo de Abrangência do Conselho."
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_tipo_abrangencia';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_abrangencia",
         *     type="string",
         *     description="Nome do Tipo de Abrangência do Conselho."
         *   )
         */
        'tx_nome_abrangencia',
    ];
}
