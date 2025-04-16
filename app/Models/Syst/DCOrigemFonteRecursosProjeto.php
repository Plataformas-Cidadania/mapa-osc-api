<?php

namespace App\Models\Syst;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_origem_fonte_recursos_projeto
 * @property string $tx_nome_origem_fonte_recursos_projeto
 * @property DCFonteRecursosProjeto[] $origem_fonte_recursos_projetos
 * @property DCFonteRecursosProjeto[] $fonte_recursos_projetos
 * 
 * @OA\Schema(
 *   schema="DCOrigemFonteRecursosProjeto",
 *   description="Objeto da fonte de recursos do projeto ",
 * )
 */
class DCOrigemFonteRecursosProjeto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_origem_fonte_recursos_projeto';

    /**
     * @OA\Property(
     *     property="cd_origem_fonte_recursos_projeto",
     *     type="integer",
     *     description="Número de identificação da fonte de recursos do projeto"
     *   )
     * The primary key for the model.
     * 
     * @var int
     */
    protected $primaryKey = 'cd_origem_fonte_recursos_projeto';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_origem_fonte_recursos_projeto",
         *     type="string",
         *     description="Nome da fonte de recursos do projeto"
         *   )
         */
        'tx_nome_origem_fonte_recursos_projeto'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fontes_recursos_projeto()
    {
        return $this->hasMany('App\Models\Osc\FonteRecursosProjeto', 'cd_origem_fonte_recursos_projeto', 'cd_origem_fonte_recursos_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dc_fonte_recursos_projeto()
    {
        return $this->hasMany('App\Models\Syst\DCFonteRecursosProjeto', 'cd_origem_fonte_recursos_projeto', 'cd_origem_fonte_recursos_projeto');
    }
}
