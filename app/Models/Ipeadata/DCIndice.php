<?php

namespace App\Models\Ipeadata;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_indice
 * @property string $tx_nome_indice
 * @property string $tx_sigla
 * @property string $tx_tema
 * @property IpeaData[] $ipea_datas
 * @property DCIpeadataUff[] $ipea_datas_uff
 * 
 * @OA\Schema(
 *   schema="DCIndice",
 *   description="Objeto de indice ",
 * )
 */
class DCIndice extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ipeadata.tb_indice';

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
    protected $primaryKey = 'cd_indice';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_indice",
         *     type="string",
         *     description="Nome do indice."
         *   )
         */
        'tx_nome_indice', 
        
        /**
         * @OA\Property(
         *     property="tx_sigla",
         *     type="string",
         *     description="Sigla do indice."
         *   )
         */
        'tx_sigla', 
        
        /**
         * @OA\Property(
         *     property="tx_tema",
         *     type="string",
         *     description="Tema do indice."
         *   )
         */
        'tx_tema'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ipea_datas()
    {
        return $this->hasMany('App\Models\IpeaData\IpeaData', 'cd_indice', 'cd_indice');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ipea_data_ufs()
    {
        return $this->hasMany('App\Models\IpeaData\DCIpeadataUff', 'cd_indice', 'cd_indice');
    }
}
