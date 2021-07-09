<?php

namespace App\Models\Syst;

use App\Models\Osc\Projeto;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_abrangencia_projeto
 * @property string $tx_nome_abrangencia_projeto
 * @property Projeto[] $projetos
 */
class DCAbrangenciaProjeto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_abrangencia_projeto';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_abrangencia_projeto';

    /**
     * @var array
     */
    protected $fillable = ['tx_nome_abrangencia_projeto'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projetos()
    {
        return $this->hasMany('App\Models\Osc\Projeto', 'cd_abrangencia_projeto', 'cd_abrangencia_projeto');
    }
}
