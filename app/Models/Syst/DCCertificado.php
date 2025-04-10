<?php

namespace App\Models\Syst;

use App\Models\Osc\Certificado;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_certificado
 * @property string $tx_nome_certificado
 * @property Certificado[] $certificados
 * 
 * @OA\Schema(
 *   schema="DCCertificado",
 *   description="Objeto de certificado ",
 * )
 */
class DCCertificado extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_certificado';

    /**
     * @OA\Property(
     *     property="cd_certificado",
     *     type="integer",
     *     description="Número de identificação do certificado"
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_certificado';

    /**
     * 
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_certificado",
         *     type="string",
         *     description="Nome do certificado"
         *   )
         */
        'tx_nome_certificado'];

}
