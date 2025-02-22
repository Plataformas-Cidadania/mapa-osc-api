<?php

namespace App\Models\Osc;

use DeepCopy\Matcher\PropertyNameMatcher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @property int $id_osc
 * @property float $cd_natureza_juridica_osc
 * @property int $cd_situacao_imovel_osc
 * @property string $ft_natureza_juridica_osc
 * @property string $tx_razao_social_osc
 * @property string $ft_razao_social_osc
 * @property string $tx_nome_fantasia_osc
 * @property string $ft_nome_fantasia_osc
 * @property string $im_logo
 * @property string $ft_logo
 * @property string $tx_missao_osc
 * @property string $ft_missao_osc
 * @property string $tx_visao_osc
 * @property string $ft_visao_osc
 * @property string $dt_fundacao_osc
 * @property string $ft_fundacao_osc
 * @property string $dt_ano_cadastro_cnpj
 * @property string $ft_ano_cadastro_cnpj
 * @property string $tx_sigla_osc
 * @property string $ft_sigla_osc
 * @property string $tx_resumo_osc
 * @property string $ft_resumo_osc
 * @property string $ft_situacao_imovel_osc
 * @property string $tx_link_estatuto_osc
 * @property string $ft_link_estatuto_osc
 * @property string $tx_historico
 * @property string $ft_historico
 * @property string $tx_finalidades_estatutarias
 * @property string $ft_finalidades_estatutarias
 * @property string $tx_link_relatorio_auditoria
 * @property string $ft_link_relatorio_auditoria
 * @property string $tx_link_demonstracao_contabil
 * @property string $ft_link_demonstracao_contabil
 * @property string $tx_nome_responsavel_legal
 * @property string $ft_nome_responsavel_legal
 * @property string $cd_classe_atividade_economica_osc
 * @property string $ft_classe_atividade_economica_osc
 * @property boolean $bo_nao_possui_sigla_osc
 * @property boolean $bo_nao_possui_link_estatuto_osc
 * @property \App\Models\Syst\DCNaturezaJuridica $natureza_juridica
 * @property \App\Models\Syst\DCClasseAtividadeEconomica $classe_atividade_economica
 * @property \App\Models\Syst\DCSituacaoImovel $situacao_imovel
 * @property Osc $osc
 */
class DadosGerais extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'osc.tb_dados_gerais';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_osc';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
    public $incrementing = false;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'cd_natureza_juridica_osc',
        'cd_situacao_imovel_osc',
        'ft_natureza_juridica_osc',
        'tx_razao_social_osc',
        'ft_razao_social_osc',
        'tx_nome_fantasia_osc',
        'ft_nome_fantasia_osc',
        'im_logo', 'ft_logo',
        'tx_missao_osc',
        'ft_missao_osc',
        'tx_visao_osc',
        'ft_visao_osc',
        'dt_fundacao_osc',
        'ft_fundacao_osc',
        'dt_ano_cadastro_cnpj',
        'ft_ano_cadastro_cnpj',
        'tx_sigla_osc',
        'ft_sigla_osc',
        'tx_resumo_osc',
        'ft_resumo_osc',
        'ft_situacao_imovel_osc',
        'tx_link_estatuto_osc',
        'ft_link_estatuto_osc',
        'tx_historico',
        'ft_historico',
        'tx_finalidades_estatutarias',
        'ft_finalidades_estatutarias',
        'tx_link_relatorio_auditoria',
        'ft_link_relatorio_auditoria',
        'tx_link_demonstracao_contabil',
        'ft_link_demonstracao_contabil',
        'tx_nome_responsavel_legal',
        'ft_nome_responsavel_legal',
        'cd_classe_atividade_economica_osc',
        'ft_classe_atividade_economica_osc',
        'bo_nao_possui_sigla_osc',
        'bo_nao_possui_link_estatuto_osc'
    ];

    protected $attributes = [
        'ft_natureza_juridica_osc' => 'Representante de OSC',
        'ft_razao_social_osc' => 'Representante de OSC',
        'ft_nome_fantasia_osc' => 'Representante de OSC',
        'ft_logo' => 'Representante de OSC',
        'ft_missao_osc' => 'Representante de OSC',
        'ft_visao_osc' => 'Representante de OSC',
        'ft_fundacao_osc' => 'Representante de OSC',
        'ft_ano_cadastro_cnpj' => 'Representante de OSC',
        'ft_sigla_osc' => 'Representante de OSC',
        'ft_resumo_osc' => 'Representante de OSC',
        'ft_situacao_imovel_osc' => 'Representante de OSC',
        'ft_link_estatuto_osc' => 'Representante de OSC',
        'ft_historico' => 'Representante de OSC',
        'ft_finalidades_estatutarias' => 'Representante de OSC',
        'ft_link_relatorio_auditoria' => 'Representante de OSC',
        'ft_link_demonstracao_contabil' => 'Representante de OSC',
        'ft_nome_responsavel_legal' => 'Representante de OSC',
        'ft_classe_atividade_economica_osc' => 'Representante de OSC'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function classe_atividade_economica()
    {
        return $this->hasOne('App\Models\Syst\DCClasseAtividadeEconomica', 'cd_classe_atividade_economica', 'cd_classe_atividade_economica_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function natureza_juridica()
    {
        return $this->belongsTo('App\Models\Syst\DCNaturezaJuridica', 'cd_natureza_juridica_osc', 'cd_natureza_juridica');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function situacao_imovel()
    {
        return $this->belongsTo('App\Models\Syst\DCSituacaoImovel', 'cd_situacao_imovel_osc', 'cd_situacao_imovel');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function osc()
    {
        return $this->belongsTo('App\Models\Osc\Osc', 'id_osc', 'id_osc');
    }
}
