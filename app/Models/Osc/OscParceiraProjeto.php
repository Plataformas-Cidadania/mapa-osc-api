<?php

namespace App\Models\Osc;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_osc_parceira_projeto
 * @property int $id_osc
 * @property int $id_projeto
 * @property string $ft_osc_parceira_projeto
 * @property boolean $bo_oficial
 * @property Osc $osc
 * @property Projeto $projeto
 * 
 * @OA\Schema(
 *   schema="OscParceiraProjeto",
 *   description="Objeto de OSC parceira de projeto ",
 * )
 */
class OscParceiraProjeto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'osc.tb_osc_parceira_projeto';

    /**
     * @OA\Property(
     *     property="id_osc_parceira_projeto",
     *     type="integer",
     *     description="Número de identificação da OSC parceira de projeto"
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_osc_parceira_projeto';

    /**
     * @var array
     */
    protected $fillable = [

        /**
         *   @OA\Property(
         *     property="id_osc",
         *     type="integer",
         *     description="Identificação da OSC."
         *   )
         */
        'id_osc',

         /**
         *   @OA\Property(
         *     property="id_projeto",
         *     type="integer",
         *     description="Identificação de projeto."
         *   )
         */
        'id_projeto',

         /**
         *   @OA\Property(
         *     property="ft_osc_parceira_projeto",
         *     type="integer",
         *     description="Fonte de origem da OSC parceira de projeto."
         *   )
         */
        'ft_osc_parceira_projeto',

         /**
         *   @OA\Property(
         *     property="bo_oficial",
         *     type="integer",
         *     description="BO oficial."
         *   )
         */
        'bo_oficial'
    ];

    protected $attributes = [
        'ft_osc_parceira_projeto' => 'Representante de OSC',
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
    public function projeto()
    {
        return $this->belongsTo('App\Models\Osc\Projeto', 'id_projeto', 'id_projeto');
    }
}
