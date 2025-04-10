<?php

namespace App\Models\Syst;

use App\Models\Osc\DadosGerais;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $cd_situacao_imovel
 * @property string $tx_nome_situacao_imovel
 * @property DadosGerais $dados_gerais
 * 
 * @OA\Schema(
 *   schema="DCSituacaoImovel",
 *   description="Objeto de situação do imovel ",
 * )
 */
class DCSituacaoImovel extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'syst.dc_situacao_imovel';

    /**
     * @OA\Property(
     *     property="cd_situacao_imovel",
     *     type="integer",
     *     description="Número de identificação da situação do imovel"
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'cd_situacao_imovel';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         * @OA\Property(
         *     property="tx_nome_situacao_imovel",
         *     type="string",
         *     description="Nome da situação do imovel."
         *   )
         */        
        'tx_nome_situacao_imovel'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dados_gerais()
    {
        return $this->hasMany('App\Models\Osc\DadosGerais', 'cd_situacao_imovel_osc', 'cd_situacao_imovel');
    }
}
