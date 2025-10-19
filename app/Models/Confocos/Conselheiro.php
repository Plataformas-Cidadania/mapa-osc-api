<?php

namespace App\Models\Confocos;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_conselheiro
 * @property string $tx_nome_conselheiro
 * @property string $tx_orgao_origem
 * @property boolean $bo_conselheiro_ativo
 * @property int $cd_identificador_orgao
 * @property int $dt_data_vinculo
 * @property int $dt_data_final_vinculo
 * @property boolean $bo_eh_governamental
 *
 * @OA\Schema(
 *   schema="Confocos",
 *   description="Conselho model",
 * )
 * 
 */
class Conselheiro extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'confocos.tb_conselheiro';

    /**
     *   @OA\Property(
     *     property="id_conselheiro",
     *     type="integer",
     *     description="Número de identificação da Conselheiro"
     *   )
     *   
     * The primary key for the model.
     * 
     * @var integer
     */
    protected $primaryKey = 'id_conselheiro';



    /**
     * @var array
     */
    protected $fillable = [

        /**
         *   @OA\Property(
         *     property="tx_nome_conselheiro",
         *     type="string",
         *     description="Nome do Conselheiro"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'tx_nome_conselheiro',

        /**
         *   @OA\Property(
         *     property="tx_orgao_origem",
         *     type="string",
         *     description="Orgão de Origem do Conselheiro (Pode ser Governamental ou OSC)"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'tx_orgao_origem',

        /**
         *   @OA\Property(
         *     property="cd_identificador_orgao",
         *     type="integer",
         *     description="CNPJ da Osc ou do Orgão de Origem"
         *   )
         *
         * The primary key for the model.
         *
         * @var integer
         */
        'cd_identificador_orgao',

        /**
         *   @OA\Property(
         *     property="bo_conselheiro_ativo",
         *     type="boolean",
         *     description="Campo define se o Conselheiro está ativo ou não na Portal"
         *   )
         *
         * The primary key for the model.
         *
         * @var boolean
         */
        'bo_conselheiro_ativo',

        /**
         *   @OA\Property(
         *     property="dt_data_vinculo",
         *     type="datetime",
         *     description="Data de entrada no Conselho"
         *   )
         *
         * The primary key for the model.
         *
         * @var datetime
         */
        'dt_data_vinculo',

        /**
         *   @OA\Property(
         *     property="dt_data_final_vinculo",
         *     type="datetime",
         *     description="Data de saída no Conselho"
         *   )
         *
         * The primary key for the model.
         *
         * @var datetime
         */
        'dt_data_final_vinculo',

        /**
         *   @OA\Property(
         *     property="bo_eh_governamental",
         *     type="boolean",
         *     description="Campo define se o Conselheiro é do Governo ou de uma OSC"
         *   )
         *
         * The primary key for the model.
         *
         * @var boolean
         */
        'bo_eh_governamental',

        /**
         *   @OA\Property(
         *     property="id_conselho",
         *     type="integer",
         *     description="Id do Conselho ao qual o Conselheiro pertence"
         *   )
         *
         * The primary key for the model.
         *
         * @var integer
         */
        'id_conselho'
    ];

    /**
     * @var array
     */
    protected $with = [
        //'contato',
        //'dados_gerais'
    ];

    /**
     * @var desativar coluna BD
     */
    public $timestamps = false;

    //------------------------------------------METODOS DE RELACIONAMENTOS-------------------------------------------------------------------------------------//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function conselho()
    {
        return $this->belongsTo('App\Models\Confocos\Conselho', 'id_conselho', 'id_conselho');
    }
}
