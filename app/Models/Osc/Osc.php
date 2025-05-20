<?php

namespace App\Models\Osc;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_osc
 * @property string $tx_apelido_osc
 * @property string $ft_apelido_osc
 * @property float $cd_identificador_osc
 * @property string $ft_identificador_osc
 * @property string $ft_osc_ativa
 * @property boolean $bo_osc_ativa
 * @property boolean $bo_nao_possui_projeto
 * @property string $ft_nao_possui_projeto
 * @property Osc.tbRelacoesTrabalho $osc.tbRelacoesTrabalho
 * @property Osc.tbRecursosOsc[] $osc.tbRecursosOscs
 * @property Osc.tbGovernanca[] $osc.tbGovernancas
 * @property Osc.tbConselhoFiscal[] $osc.tbConselhoFiscals
 * @property Osc.tbCertificado[] $osc.tbCertificados
 * @property Osc.tbObjetivoOsc[] $osc.tbObjetivoOscs
 * @property Osc.tbDadosGerai $osc.tbDadosGerai
 * @property Osc.tbParticipacaoSocialOutra[] $osc.tbParticipacaoSocialOutras
 * @property Osc.tbParticipacaoSocialConferencium[] $osc.tbParticipacaoSocialConferencias
 * @property Osc.tbParticipacaoSocialConselho[] $osc.tbParticipacaoSocialConselhos
 * @property Osc.tbQuadrosSocietarios[] $osc.tbQuadrosSocietarios
 * @property Osc.tbRepresentanteConselho[] $osc.tbRepresentanteConselhos
 * @property Osc.tbLocalizacao $osc.tbLocalizacao
 * @property Osc.tbAreaAtuacao[] $osc.tbAreaAtuacaos
 * @property Osc.tbContato $osc.tbContato
 * @property Osc.tbProjeto[] $osc.tbProjetos
 * @property Osc.tbRelacoesTrabalhoOutra[] $osc.tbRelacoesTrabalhoOutras
 * @property Portal.tbRepresentacao[] $portal.tbRepresentacaos
 * @property Osc.tbRecursosOutroOsc[] $osc.tbRecursosOutroOscs
 * @property Osc.tbAreaAtuacaoOutra[] $osc.tbAreaAtuacaoOutras
 * @property Osc.tbOscParceiraProjeto[] $osc.tbOscParceiraProjetos
 * @property Portal.tbBarraTransparencium $portal.tbBarraTransparencium
 * 
 * @OA\Schema(
 *   schema="Osc",
 *   description="Osc model",
 * )
 * 
 */
class Osc extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'osc.tb_osc';

    /**
     *   @OA\Property(
     *     property="id_osc",
     *     type="integer",
     *     description="Número de identificação da Osc"
     *   )
     *   
     * The primary key for the model.
     * 
     * @var integer
     */
    protected $primaryKey = 'id_osc';



    /**
     * @var array
     */
    protected $fillable = [

        /**
         *   @OA\Property(
         *     property="tx_apelido_osc",
         *     type="string",
         *     description="Apelido da Osc"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'tx_apelido_osc',

        /**
         *   @OA\Property(
         *     property="ft_apelido_osc",
         *     type="string",
         *     description="Fonte de origem do Apelido da Osc"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'ft_apelido_osc',

        /**
         *   @OA\Property(
         *     property="cd_identificador_osc",
         *     type="integer",
         *     description="CNPJ da Osc"
         *   )
         *
         * The primary key for the model.
         *
         * @var integer
         */
        'cd_identificador_osc',

        /**
         *   @OA\Property(
         *     property="ft_identificador_osc",
         *     type="string",
         *     description="Fonte da origem do CNPJ da Osc"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'ft_identificador_osc',

        'ft_osc_ativa',

        /**
         *   @OA\Property(
         *     property="bo_osc_ativa",
         *     type="integer",
         *     description="Campo descreve ativação da OSC no Portal"
         *   )
         *
         * The primary key for the model.
         *
         * @var integer
         */
        'bo_osc_ativa',

        /**
         *   @OA\Property(
         *     property="bo_nao_possui_projeto",
         *     type="integer",
         *     description="Campo que diz se a OSC tem projeto ou não"
         *   )
         *
         * The primary key for the model.
         *
         * @var integer
         */
        'bo_nao_possui_projeto',

        /**
         *   @OA\Property(
         *     property="ft_nao_possui_projeto",
         *     type="string",
         *     description="Fonte da origem do Campo que diz se a OSC tem projeto ou não"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'ft_nao_possui_projeto',

        /**
         *   @OA\Property(
         *     property="bo_nao_possui_ps_conselhos",
         *     type="integer",
         *     description="Campo que diz se a OSC tem conselhos ou não"
         *   )
         *
         * The primary key for the model.
         *
         * @var integer
         */
        'bo_nao_possui_ps_conselhos',

        /**
         *   @OA\Property(
         *     property="ft_nao_possui_ps_conselhos",
         *     type="string",
         *     description="Fonte da origem do Campo que diz se a OSC tem conselhos ou não"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'ft_nao_possui_ps_conselhos',

        /**
         *   @OA\Property(
         *     property="bo_nao_possui_ps_conferencias",
         *     type="integer",
         *     description="Campo que diz se a OSC tem conferencias ou não"
         *   )
         *
         * The primary key for the model.
         *
         * @var integer
         */
        'bo_nao_possui_ps_conferencias',

        /**
         *   @OA\Property(
         *     property="ft_nao_possui_ps_conferencias",
         *     type="string",
         *     description="Fonte da origem do Campo que diz se a OSC tem conferencias ou não"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'ft_nao_possui_ps_conferencias',

        /**
         *   @OA\Property(
         *     property="bo_nao_possui_ps_outros_espacos",
         *     type="integer",
         *     description="Campo que diz se a OSC tem outros espaços ou não"
         *   )
         *
         * The primary key for the model.
         *
         * @var integer
         */
        'bo_nao_possui_ps_outros_espacos',

        /**
         *   @OA\Property(
         *     property="ft_nao_possui_ps_outros_espacos",
         *     type="string",
         *     description="Fonte da origem do Campo que diz se a OSC tem outros espaços ou não"
         *   )
         *
         * The primary key for the model.
         *
         * @var string
         */
        'ft_nao_possui_ps_outros_espacos',

        'cd_situacao_cadastral',
    ];

    protected $attributes = [
        'ft_apelido_osc' => 'Representante de OSC',
        'ft_identificador_osc' => 'Representante de OSC',
        'ft_osc_ativa' => 'Representante de OSC',
        'ft_nao_possui_projeto' => 'Representante de OSC',
        'ft_nao_possui_ps_conselhos' => 'Representante de OSC',
        'ft_nao_possui_ps_conferencias' => 'Representante de OSC',
        'ft_nao_possui_ps_outros_espacos' => 'Representante de OSC'
    ];

    /**
     * @var array
     */
    protected $with = [
        //'contato',
        //'dados_gerais',
        //'areas_e_subareas_atuacao',
        //'titulos_e_certificados',
        //'trabalhadores',
        //'quadro_de_dirigentes',
        //'conselho_fiscal',
        //'conselhos_politicas_publicas',
        //'conferencias_politicas_publicas',
        //'outros_espacos_participacao_social',
        //'projetos',
        //'localizacao'
    ];

    /**
     * @var desativar coluna BD
     */
    public $timestamps = false;

    //------------------------------------------METODOS DE RELACIONAMENTOS-------------------------------------------------------------------------------------//
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dados_gerais()
    {
        return $this->hasOne('App\Models\Osc\DadosGerais', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function titulos_e_certificados()
    {
        return $this->hasMany('App\Models\Osc\Certificado', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quadro_de_dirigentes()
    {
        return $this->hasMany('App\Models\Osc\Governanca', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conselho_fiscal()
    {
        return $this->hasMany('App\Models\Osc\ConselhoFiscal', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function relacoes_trabalho()
    {
        return $this->hasOne('App\Models\Osc\RelacoesTrabalho', 'id_osc', 'id_osc');
    }

    //-----------------------------------Espaço de Participação Social----------------------------------------//
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conselhos_politicas_publicas()
    {
        return $this->hasMany('App\Models\Osc\ParticipacaoSocialConselho', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conferencias_politicas_publicas()
    {
        return $this->hasMany('App\Models\Osc\ParticipacaoSocialConferencia', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function outros_espacos_participacao_social()
    {
        return $this->hasMany('App\Models\Osc\ParticipacaoSocialOutra', 'id_osc', 'id_osc');
    }

    //-----------------------------------FIM Espaço de Participação Social----------------------------------------//

    //-----------------------------------Projetos----------------------------------------//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projetos()
    {
        return $this->hasMany('App\Models\Osc\Projeto', 'id_osc', 'id_osc');
    }

    //-----------------------------------FIM Projetos----------------------------------------//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function objetivos()
    {
        return $this->hasMany('App\Models\Osc\ObjetivoOsc', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function representantesConselho()
    {
        return $this->hasMany('App\Models\Osc\RepresentanteConselho', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quadrosSocietarios()
    {
        return $this->hasMany('App\Models\Osc\QuadroSocietario', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function localizacao()
    {
        return $this->hasOne('App\Models\Osc\Localizacao', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function areas_e_subareas_atuacao()
    {
        return $this->hasMany('App\Models\Osc\AreaAtuacao', 'id_osc', 'id_osc');
        //return $this->hasManyThrough('App\Models\Syst\DCAreaAtuacao', 'App\Models\Osc\AreaAtuacao', 'id_osc', 'cd_area_atuacao', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contato()
    {
        return $this->hasOne('App\Models\Osc\Contato', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function relacoesTrabalhoOutras()
    {
        return $this->hasMany('App\Models\Osc\RelacoesTrabalhoOutra', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function representacoes()
    {
        return $this->hasMany('App\Models\Portal\Representacao', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recursosOutrosOsc()
    {
        return $this->hasMany('App\Models\Osc\RecursosOutroOsc', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function areasAtuacaoOutras()
    {
        return $this->hasMany('App\Models\Osc\AreaAtuacaoOutra', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parceirasProjetos()
    {
        return $this->hasMany('App\Models\Osc\OscParceiraProjeto', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function barraTransparencia()
    {
        return $this->hasOne('App\Models\Portal\BarraTransparencia', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recursos()
    {
        return $this->hasMany('App\Models\Osc\FonteRecursos', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function situacao_cadastral()
    {
        return $this->belongsTo('App\Models\Syst\DCSituacaoCadastral', 'cd_situacao_cadastral', 'cd_situacao_cadastral');
    }

}
