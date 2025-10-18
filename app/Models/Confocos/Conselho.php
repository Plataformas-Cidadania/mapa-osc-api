<?php

namespace App\Models\Confocos;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_conselho
 * @property string $tx_nome_conselho
 * @property string $tx_ato_legal
 * @property string $tx_website
 * @property boolean $bo_conselho_ativo
 * @property int $nr_total_conselheiros_titulares
 * @property int $cd_nivel_federativo
 * @property int $cd_tipo_abrangencia
 *
 * @OA\Schema(
 *   schema="Confocos",
 *   description="Conselho model",
 * )
 * 
 */
class Conselho extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'confocos.tb_conselho';

    /**
     *   @OA\Property(
     *     property="id_conselho",
     *     type="integer",
     *     description="Número de identificação da Conselho"
     *   )
     *   
     * The primary key for the model.
     * 
     * @var integer
     */
    protected $primaryKey = 'id_conselho';



    /**
     * @var array
     */
    protected $fillable = [

        /**
         *   @OA\Property(
         *     property="tx_nome_conselho",
         *     type="string",
         *     description="Nome do Conselho"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'tx_nome_conselho',

        /**
         *   @OA\Property(
         *     property="tx_ato_legal",
         *     type="string",
         *     description="Ato legal de Criação do Conselho"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'tx_ato_legal',

        /**
         *   @OA\Property(
         *     property="tx_website",
         *     type="string",
         *     description="Website do Conselho"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'tx_website',

        /**
         *   @OA\Property(
         *     property="bo_conselho_ativo",
         *     type="integer",
         *     description="Campo descreve ativação do Conselho no Portal"
         *   )
         *
         * The primary key for the model.
         *
         * @var integer
         */
        'bo_conselho_ativo',

        /**
         *   @OA\Property(
         *     property="nr_total_conselheiros_titulares",
         *     type="integer",
         *     description="Quantitativo de Conselheiros Titulares"
         *   )
         *
         * The primary key for the model.
         *
         * @var integer
         */
        'nr_total_conselheiros_titulares',

        /**
         *   @OA\Property(
         *     property="cd_nivel_federativo",
         *     type="integer",
         *     description="Codigo do Nível Federativo do Conselho"
         *   )
         *
         * The primary key for the model.
         *
         * @var codigo
         */
        'cd_nivel_federativo',

        /**
         *   @OA\Property(
         *     property="cd_tipo_abrangencia",
         *     type="integer",
         *     description="Codigo do Tipo de Abragência do Conselho"
         *   )
         *
         * The primary key for the model.
         *
         * @var codigo
         */
        'cd_tipo_abrangencia'
    ];

    /**
     * @var array
     */
    protected $with = [
        //'contato',
        //'dados_gerais',
        //'areas_e_subareas_atuacao',
        //'titulos_e_certificados',
        //'trabalhadores',
        //'quadro_de_dirigentes',
        //'conselho_fiscal',
        //'conselhos_politicas_publicas',
        //'conferencias_politicas_publicas',
        //'outros_espacos_participacao_social',
        //'projetos',
        //'localizacao'
    ];

    /**
     * @var desativar coluna BD
     */
    public $timestamps = false;

    //------------------------------------------METODOS DE RELACIONAMENTOS-------------------------------------------------------------------------------------//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nivel_federativo()
    {
        return $this->hasOne('App\Models\Confocos\DCNivelFederativo', 'cd_nivel_federativo', 'cd_nivel_federativo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipo_abrangencia()
    {
        return $this->hasOne('App\Models\Confocos\DCTipoAbrangenciaConselho', 'cd_tipo_abrangencia', 'cd_tipo_abrangencia');
    }

    public function conselheiros()
    {
        return $this->hasMany('App\Models\Confocos\Conselheiro', 'id_conselho', 'id_conselho');
    }

    //    /**
//     * @return \Illuminate\Database\Eloquent\Relations\HasOne
//     */
//    public function dados_gerais()
//    {
//        return $this->hasOne('App\Models\Osc\DadosGerais', 'id_osc', 'id_osc');
//    }

//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\HasOne
//     */
//    public function localizacao()
//    {
//        return $this->hasOne('App\Models\Osc\Localizacao', 'id_osc', 'id_osc');
//    }

}
