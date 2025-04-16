<?php

namespace App\Models\Syst;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_objetivo_projeto
 * @property string $tx_nome_objetivo_projeto
 * @property string $tx_codigo_objetivo_projeto
 * @property DCMetaProjeto[] $metaProjetos
 * 
 * @OA\Schema(
 *   schema="DCObjetivoProjeto",
 *   description="Objeto do objetivo de projeto."
 * )
 */
class DCObjetivoProjeto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_objetivo_projeto';

    /**
     * @OA\Property(
     *     property="cd_objetivo_projeto",
     *     type="integer",
     *     description="Número do objetivo de projeto."
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_objetivo_projeto';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_objetivo_projeto",
         *     type="string",
         *     description="Nome do objetivo de projeto."
         *   )
         */    
        'tx_nome_objetivo_projeto', 
        
        /**
         * @OA\Property(
         *     property="tx_codigo_objetivo_projeto",
         *     type="string",
         *     description="Nome do número do objetivo de projeto."
         *   )
         */
        'tx_codigo_objetivo_projeto'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meta_projetos()
    {
        return $this->hasMany('App\Models\Syst\DCMetaProjeto', 'cd_objetivo_projeto', 'cd_objetivo_projeto');
    }
}
