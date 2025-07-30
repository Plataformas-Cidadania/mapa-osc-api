<?php

namespace App\Models\Syst;

use App\Models\Osc\Projeto;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_zona_atuacao_projeto
 * @property string $tx_nome_zona_atuacao
 * @property Projeto[] $projetos
 * 
 * @OA\Schema(
 *   schema="DCZonaAtuacaoProjeto",
 *   description="Objeto da zona de atuação do projeto ",
 * )
 */
class DCZonaAtuacaoProjeto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_zona_atuacao_projeto';

    /**
     * @OA\Property(
     *     property="cd_zona_atuacao_projeto",
     *     type="integer",
     *     description="Número de identificação da zona de atuação do projeto"
     *   )
     * The primary key for the model.
     * 
     * @var int
     */
    protected $primaryKey = 'cd_zona_atuacao_projeto';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_zona_atuacao",
         *     type="string",
         *     description="Nome da zona de atuação do projeto"
         *   )
         */
        'tx_nome_zona_atuacao'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projetos()
    {
        return $this->hasMany('App\Models\Osc\Projeto', 'cd_zona_atuacao_projeto', 'cd_zona_atuacao_projeto');
    }
}
