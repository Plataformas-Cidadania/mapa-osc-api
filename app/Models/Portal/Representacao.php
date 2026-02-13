<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_representacao
 * @property int $id_osc
 * @property int $id_usuario
 * @property Osc.tbOsc $osc.tbOsc
 * @property Portal.tbUsuario $portal.tbUsuario
 *
 * @OA\Schema(
 *     schema="Representacao",
 *     description="Representacao model",
 *   )
 */
class Representacao extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'portal.tb_representacao';

    /**
     *   @OA\Property(
     *     property="id_representacao",
     *     type="integer",
     *     description="ID da Representação gerado automaticamente pelo sistema"
     *   )
     *
    /**
     * The primary key for the model.
     * 
     * @var integer
     */
    protected $primaryKey = 'id_representacao';


    /**
     * @var array
     */
    protected $fillable = [

        /**
         *   @OA\Property(
         *     property="id_osc",
         *     type="integer",
         *     description="ID da Osc ligada a Representação"
         *   )
         *
        /**
         * The primary key for the model.
         *
         * @var integer
         */
        'id_osc',

        /**
         *   @OA\Property(
         *     property="id_usuario",
         *     type="integer",
         *     description="ID da Usuário ligado a Representação"
         *   )
         *
        * /**
         * The primary key for the model.
         *
         * @var integer
         */
        'id_usuario'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function osc()
    {
        return $this->belongsTo('App\Models\Osc\Osc', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo('App\Models\Portal\Usuario', 'id_usuario', 'id_usuario');
    }
}
