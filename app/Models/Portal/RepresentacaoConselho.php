<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_representacao
 * @property int $id_conselho
 * @property int $id_usuario
 * @property datetime $dt_data_vinculo
 *
 *
 * @OA\Schema(
 *    schema="RepresentacaoConselho",
 *    description="RepresentacaoConselho model",
 *  )
 *
 * /
 */
class RepresentacaoConselho extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'portal.tb_representacao_conselho';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_representacao';

    /**
     * @var array
     */
    protected $fillable = [

        'id_conselho',

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
        'id_usuario',

        /**
         *   @OA\Property(
         *     property="dt_data_vinculo",
         *     type="datetime",
         *     description="Data que foi criado a Representação"
         *   )
         *
         * /**
         * The primary key for the model.
         *
         * @var datetime
         */
        'dt_data_vinculo'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function conselho()
    {
        return $this->belongsTo('App\Models\Confocos\Conselho', 'id_conselho', 'id_conselho');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        return $this->belongsTo('App\Models\Portal\Usuario', 'id_usuario', 'id_usuario');
    }
}
