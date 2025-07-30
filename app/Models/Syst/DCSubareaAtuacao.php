<?php

namespace App\Models\Syst;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_subarea_atuacao
 * @property int $cd_area_atuacao
 * @property string $tx_nome_subarea_atuacao
 * @property DCAreaAtuacao $dc_area_atuacao
 * 
 * @OA\Schema(
 *   schema="DCSubareaAtuacao",
 *   description="Objeto da subarea de atuação. "
 * )
 */
class DCSubareaAtuacao extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_subarea_atuacao';

    /**
     * @OA\Property(
     *     property="cd_subarea_atuacao",
     *     type="integer",
     *     description="Número de identificação da subarea de atuação."
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_subarea_atuacao';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="cd_area_atuacao",
         *     type="integer",
         *     description="Número de identificação da area de atuação."
         *   )
         */
        'cd_area_atuacao', 
        
        /**
         * @OA\Property(
         *     property="tx_nome_subarea_atuacao",
         *     type="string",
         *     description="Nome da subarea de atuação."
         *   )
         */
        'tx_nome_subarea_atuacao'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dc_area_atuacao()
    {
        return $this->belongsTo('App\Models\Syst\DCAreaAtuacao', 'cd_area_atuacao', 'cd_area_atuacao');
    }
}
