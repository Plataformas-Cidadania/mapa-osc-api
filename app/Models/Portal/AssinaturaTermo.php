<?php

namespace App\Models\Portal;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_assinatura
 * @property int $id_representacao
 * @property int $id_termo
 * @property Portal.tbRepresentacao $portal.tbRepresentacao
 * @property Portal.tbTermos $portal.tbTermos
 *
 * @OA\Schema(
 *    schema="AssinaturaTermo",
 *    description="AssinaturaTermo model",
 *  )
 */
class AssinaturaTermo extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'portal.tb_assinatura_termo';

    /**
     * @OA\Property(
     *      property="id_assinatura",
     *      type="integer",
     *      description="Número de identificação da Assinatura do Termo"
     *    )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_assinatura';

    /**
     * @var array
     */
    protected $fillable = [

        /**
         *   @OA\Property(
         *     property="id_representacao",
         *     type="int",
         *     description="Identificação da Representação Criada para OSC."
         *   )
         */
        'id_representacao',

        /**
         *   @OA\Property(
         *     property="id_termo",
         *     type="int",
         *     description="Identificação do Termo Assinado."
         *   )
         */
        'id_termo'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function representacao()
    {
        return $this->belongsTo('App\Models\Portal\Representacao', 'id_representacao', 'id_representacao');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function termo()
    {
        return $this->belongsTo('App\Models\Portal\Termo', 'id_termo', 'id_termo');
    }
}
