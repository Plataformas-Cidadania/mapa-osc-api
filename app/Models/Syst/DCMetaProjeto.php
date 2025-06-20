<?php

namespace App\Models\Syst;

use App\Models\Osc\ObjetivoOsc;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_meta_projeto
 * @property int $cd_objetivo_projeto
 * @property string $tx_nome_meta_projeto
 * @property string $tx_codigo_meta_projeto
 * @property DCObjetivoProjeto $objetivoProjeto
 * @property ObjetivoOsc[] $objetivoOscs
 * @property ObjetivoProjeto[] $objetivoProjetos
 * 
 * @OA\Schema(
 *   schema="DCMetaProjeto",
 *   description="Objeto metas de projeto."
 * )
 */
class DCMetaProjeto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_meta_projeto';

    /**
     * @OA\Property(
     *     property="cd_meta_projeto",
     *     type="integer",
     *     description="Número de meta de projeto."
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_meta_projeto';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="cd_objetivo_projeto",
         *     type="integer",
         *     description="Número de identificação do objetivo de projeto."
         *   )
         */
        'cd_objetivo_projeto',
        
        /**
         * @OA\Property(
         *     property="tx_nome_meta_projeto",
         *     type="string",
         *     description="Nome da meta de projeto."
         *   )
         */
        'tx_nome_meta_projeto', 
        
        /**
         * @OA\Property(
         *     property="tx_codigo_meta_projeto",
         *     type="string",
         *     description="Nome do número da meta de projeto."
         *   )
         */
        'tx_codigo_meta_projeto'
    ];

    public $timestamps = false;

    protected $with = ['objetivo_projeto'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function objetivo_projeto()
    {
        return $this->belongsTo('App\Models\Syst\DCObjetivoProjeto', 'cd_objetivo_projeto', 'cd_objetivo_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function objetivo_oscs()
    {
        return $this->hasMany('App\Models\Osc\ObjetivoOsc', 'cd_meta_osc', 'cd_meta_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function objetivo_projetos()
    {
        return $this->hasMany('App\Models\Osc\ObjetivoProjeto', 'cd_meta_projeto', 'cd_meta_projeto');
    }
}
