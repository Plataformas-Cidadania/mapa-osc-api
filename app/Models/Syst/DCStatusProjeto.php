<?php

namespace App\Models\Syst;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_status_projeto
 * @property string $tx_nome_status_projeto
 * @property Osc.tbProjeto[] $osc.tbProjetos
 * 
 * @OA\Schema(
 *   schema="DCStatusProjeto",
 *   description="Objeto de status do projeto ",
 * )
 */
class DCStatusProjeto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_status_projeto';

    /**
     * @OA\Property(
     *     property="cd_status_projeto",
     *     type="integer",
     *     description="Número de identificação status do projeto"
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_status_projeto';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_status_projeto",
         *     type="string",
         *     description="Nome do status do projeto"
         *   )
         */
        'tx_nome_status_projeto'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projetos()
    {
        return $this->hasMany('App\Models\Osc\Projeto', 'cd_status_projeto', 'cd_status_projeto');
    }
}
