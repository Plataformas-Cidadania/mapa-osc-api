<?php

namespace App\Models\Syst;

use App\Models\Osc\Projeto;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_zona_atuacao_projeto
 * @property string $tx_nome_zona_atuacao
 * @property Projeto[] $projetos
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
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_zona_atuacao_projeto';

    /**
     * @var array
     */
    protected $fillable = ['tx_nome_zona_atuacao'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projetos()
    {
        return $this->hasMany('App\Models\Osc\Projeto', 'cd_zona_atuacao_projeto', 'cd_zona_atuacao_projeto');
    }
}
