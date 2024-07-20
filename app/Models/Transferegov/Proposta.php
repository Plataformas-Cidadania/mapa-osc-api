<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int $id_proposta
 * @property string $uf_proponente
 * @property string $munic_proponente
 * @property int $cod_munic_ibge
 * @property int $cod_orgao_sup
 * @property string $desc_orgao_sup
 * @property string $natureza_juridica
 * @property string $nr_proposta
 * @property int $dia_prop
 * @property int $mes_prop
 * @property int $ano_prop
 * @property string $dia_proposta
 * @property int $cod_orgao
 * @property string $desc_orgao
 * @property string $modalidade
 * @property string $identif_proponente
 * @property string $nm_proponente
 * @property int $cep_proponente
 * @property string $endereco_proponente
 * @property string $bairro_proponente
 * @property string $nm_banco
 * @property string $situacao_conta
 * @property string $situacao_projeto_basico
 * @property string $sit_proposta
 * @property string $dia_inic_vigencia_proposta
 * @property string $dia_fim_vigencia_proposta
 * @property string $objeto_proposta
 * @property string $item_investimento
 * @property string $enviada_mandataria
 * @property string $nome_subtipo_proposta
 * @property string $descricao_subtipo_proposta
 * @property string $vl_global_prop
 * @property string $vl_repasse_prop
 * @property string $vl_contrapartida_prop
 */

 class Proposta extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_proposta';

    /**
     * The primary key for the model.n
     * 
     * @var string
     */
    protected $primaryKey = 'id_proposta';

    /**
     * @var array
     */
    protected $fillable = ['id_proposta','uf_proponente','munic_proponente','cod_munic_ibge','cod_orgao_sup','desc_orgao_sup','natureza_juridica','nr_proposta','dia_prop','mes_prop','ano_prop','dia_proposta','cod_orgao','desc_orgao','modalidade','identif_proponente','nm_proponente','cep_proponente','endereco_proponente','bairro_proponente','nm_banco','situacao_conta','situacao_projeto_basico','sit_proposta','dia_inic_vigencia_proposta','dia_fim_vigencia_proposta','objeto_proposta','item_investimento','enviada_mandataria','nome_subtipo_proposta','descricao_subtipo_proposta','vl_global_prop','vl_repasse_prop','vl_contrapartida_prop'];

    public $timestamps = false;
}
