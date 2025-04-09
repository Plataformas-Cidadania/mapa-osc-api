<?php

namespace App\Models\Osc;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_projeto
 * @property int $id_osc
 * @property int $cd_status_projeto
 * @property int $cd_abrangencia_projeto
 * @property int $cd_zona_atuacao_projeto
 * @property int $cd_municipio
 * @property int $cd_uf
 * @property string $tx_nome_projeto
 * @property string $ft_nome_projeto
 * @property string $ft_status_projeto
 * @property string $dt_data_inicio_projeto
 * @property string $ft_data_inicio_projeto
 * @property string $dt_data_fim_projeto
 * @property string $ft_data_fim_projeto
 * @property string $tx_link_projeto
 * @property string $ft_link_projeto
 * @property int $nr_total_beneficiarios
 * @property string $ft_total_beneficiarios
 * @property float $nr_valor_captado_projeto
 * @property string $ft_valor_captado_projeto
 * @property float $nr_valor_total_projeto
 * @property string $ft_valor_total_projeto
 * @property string $ft_abrangencia_projeto
 * @property string $ft_zona_atuacao_projeto
 * @property string $tx_descricao_projeto
 * @property string $ft_descricao_projeto
 * @property string $ft_metodologia_monitoramento
 * @property string $tx_metodologia_monitoramento
 * @property string $tx_identificador_projeto_externo
 * @property string $ft_identificador_projeto_externo
 * @property boolean $bo_oficial
 * @property string $tx_status_projeto_outro
 * @property string $ft_municipio
 * @property string $ft_uf
 * @property Syst.dcZonaAtuacaoProjeto $syst.dcZonaAtuacaoProjeto
 * @property Syst.dcAbrangenciaProjeto $syst.dcAbrangenciaProjeto
 * @property Spat.edMunicipio $spat.edMunicipio
 * @property Syst.dcStatusProjeto $syst.dcStatusProjeto
 * @property Spat.edUf $spat.edUf
 * @property Osc.tbOsc $osc.tbOsc
 * @property Osc.tbFonteRecursosProjeto[] $osc.tbFonteRecursosProjetos
 * @property Osc.tbTipoParceriaProjeto[] $osc.tbTipoParceriaProjetos
 * @property Osc.tbLocalizacaoProjeto[] $osc.tbLocalizacaoProjetos
 * @property Osc.tbFinanciadorProjeto[] $osc.tbFinanciadorProjetos
 * @property Osc.tbAreaAtuacaoOutraProjeto[] $osc.tbAreaAtuacaoOutraProjetos
 * @property Osc.tbAreaAtuacaoProjeto[] $osc.tbAreaAtuacaoProjetos
 * @property Osc.tbPublicoBeneficiadoProjeto[] $osc.tbPublicoBeneficiadoProjetos
 * @property Osc.tbObjetivoProjeto[] $osc.tbObjetivoProjetos
 * @property Osc.tbOscParceiraProjeto[] $osc.tbOscParceiraProjetos
 * 
 * @OA\Schema(
 *   schema="Projeto",
 *   description="Projeto model",
 * )
 * 
 */
class Projeto extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'osc.tb_projeto';

    /**
     *  @OA\Property(
     *     property="id",
     *     type="string",
     *     example="",
     *     description="Número de identificação do projeto"
     *   )
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_projeto';

    /**
     * @var array
     */
    protected $fillable = [
        /**
         *   @OA\Property(
         *     property="id_osc",
         *     type="int",
         *     description="Identificação da OSC."
         *   )
         */
        'id_osc',

         /**
         *   @OA\Property(
         *     property="cd_status_projeto",
         *     type="int",
         *     description="Identificação de status do projeto."
         *   )
         */
        'cd_status_projeto',

         /**
         *   @OA\Property(
         *     property="cd_abrangencia_projeto",
         *     type="int",
         *     description="Identificação da abrangencia."
         *   )
         */
        'cd_abrangencia_projeto',

         /**
         *   @OA\Property(
         *     property="cd_zona_atuacao_projeto",
         *     type="int",
         *     description="Identificação da zona de atuação."
         *   )
         */
        'cd_zona_atuacao_projeto',

         /**
         *   @OA\Property(
         *     property="cd_municipio",
         *     type="int",
         *     description="Identificação do município."
         *   )
         */
        'cd_municipio',

         /**
         *   @OA\Property(
         *     property="cd_uf",
         *     type="string",
         *     description="Identificação do estado."
         *   )
         */
        'cd_uf',

         /**
         *   @OA\Property(
         *     property="tx_nome_projeto",
         *     type="string",
         *     description="Nome do projeto."
         *   )
         */
        'tx_nome_projeto',

         /**
         *   @OA\Property(
         *     property="ft_nome_projeto",
         *     type="string",
         *     description="Fonte do dado sobre o nome do projeto."
         *   )
         */
        'ft_nome_projeto',

         /**
         *   @OA\Property(
         *     property="ft_status_projeto",
         *     type="string",
         *     description="Fonte do dado sobre o status do projeto."
         *   )
         */
        'ft_status_projeto',

         /**
         *   @OA\Property(
         *     property="dt_data_inicio_projeto",
         *     type="string",
         *     description="Data de inicio do projeto."
         *   )
         */
        'dt_data_inicio_projeto',

         /**
         *   @OA\Property(
         *     property="ft_data_inicio_projeto",
         *     type="string",
         *     description="Fonte do dado sobre data de inicio do projeto."
         *   )
         */
        'ft_data_inicio_projeto',

         /**
         *   @OA\Property(
         *     property="dt_data_fim_projeto",
         *     type="string",
         *     description="Data de fim do projeto."
         *   )
         */
        'dt_data_fim_projeto',

         /**
         *   @OA\Property(
         *     property="ft_data_fim_projeto",
         *     type="string",
         *     description="Fonte do dado sobre data de inicio do projetoIdentificação da OSC."
         *   )
         */
        'ft_data_fim_projeto',

         /**
         *   @OA\Property(
         *     property="tx_link_projeto",
         *     type="string",
         *     description="Link do projeto."
         *   )
         */
        'tx_link_projeto',

         /**
         *   @OA\Property(
         *     property="ft_link_projeto",
         *     type="string",
         *     description="Fonte do dado sobre link do projeto."
         *   )
         */
        'ft_link_projeto',

         /**
         *   @OA\Property(
         *     property="nr_total_beneficiarios",
         *     type="string",
         *     description="Total de beneficiários."
         *   )
         */
        'nr_total_beneficiarios',

         /**
         *   @OA\Property(
         *     property="ft_total_beneficiarios",
         *     type="string",
         *     description="Fonte do dado sobre total de beneficiários."
         *   )
         */
        'ft_total_beneficiarios',

         /**
         *   @OA\Property(
         *     property="nr_valor_captado_projeto",
         *     type="string",
         *     description="Valor captado do projeto."
         *   )
         */
        'nr_valor_captado_projeto',

         /**
         *   @OA\Property(
         *     property="ft_valor_captado_projeto",
         *     type="string",
         *     description="Fonte do dado sobre valor captado do projeto."
         *   )
         */
        'ft_valor_captado_projeto',

         /**
         *   @OA\Property(
         *     property="nr_valor_total_projeto",
         *     type="string",
         *     description="Valor total do projeto."
         *   )
         */
        'nr_valor_total_projeto',

         /**
         *   @OA\Property(
         *     property="ft_valor_total_projeto",
         *     type="string",
         *     description="Fonte do dado sobre valor total do projeto."
         *   )
         */
        'ft_valor_total_projeto',

         /**
         *   @OA\Property(
         *     property="ft_abrangencia_projeto",
         *     type="string",
         *     description="Fonte do dado sobre abrangencia."
         *   )
         */
        'ft_abrangencia_projeto',

         /**
         *   @OA\Property(
         *     property="ft_zona_atuacao_projeto",
         *     type="string",
         *     description="Fonte do dado sobre zona de atuação."
         *   )
         */
        'ft_zona_atuacao_projeto',
        
         /**
         *   @OA\Property(
         *     property="tx_descricao_projeto",
         *     type="string",
         *     description="Descrição do projeto."
         *   )
         */
        'tx_descricao_projeto',

         /**
         *   @OA\Property(
         *     property="ft_descricao_projeto",
         *     type="string",
         *     description="Fonte do dado sobre descrição do projeto."
         *   )
         */
        'ft_descricao_projeto',

         /**
         *   @OA\Property(
         *     property="ft_metodologia_monitoramento",
         *     type="string",
         *     description="Fonte do dado sobre metodologia de monitoramento."
         *   )
         */
        'ft_metodologia_monitoramento',

         /**
         *   @OA\Property(
         *     property="tx_metodologia_monitoramento",
         *     type="string",
         *     description="Metodologia de monitoramento."
         *   )
         */
        'tx_metodologia_monitoramento',

         /**
         *   @OA\Property(
         *     property="tx_identificador_projeto_externo",
         *     type="string",
         *     description="Identificador do projeto externo."
         *   )
         */
        'tx_identificador_projeto_externo',

         /**
         *   @OA\Property(
         *     property="ft_identificador_projeto_externo",
         *     type="string",
         *     description="Fonte do dado sobre identificador do projeto externo."
         *   )
         */
        'ft_identificador_projeto_externo',

         /**
         *   @OA\Property(
         *     property="bo_oficial",
         *     type="boolean",
         *     description="BO oficial."
         *   )
         */
        'bo_oficial',

         /**
         *   @OA\Property(
         *     property="tx_status_projeto_outro",
         *     type="string",
         *     description="Status de outro projeto."
         *   )
         */
        'tx_status_projeto_outro',

         /**
         *   @OA\Property(
         *     property="ft_municipio",
         *     type="string",
         *     description="Fonte do dado sobre município."
         *   )
         */
        'ft_municipio',

         /**
         *   @OA\Property(
         *     property="ft_uf",
         *     type="string",
         *     description="Fonte do dado sobre estado."
         *   )
         */
        'ft_uf'
    ];

    protected $attributes = [
        'ft_nome_projeto' => 'Representante de OSC',
        'ft_status_projeto' => 'Representante de OSC',
        'ft_data_inicio_projeto' => 'Representante de OSC',
        'ft_data_fim_projeto' => 'Representante de OSC',
        'ft_link_projeto' => 'Representante de OSC',
        'ft_total_beneficiarios' => 'Representante de OSC',
        'ft_valor_captado_projeto' => 'Representante de OSC',
        'ft_valor_total_projeto' => 'Representante de OSC',
        'ft_abrangencia_projeto' => 'Representante de OSC',
        'ft_zona_atuacao_projeto' => 'Representante de OSC',
        'ft_descricao_projeto' => 'Representante de OSC',
        'ft_metodologia_monitoramento' => 'Representante de OSC',
        'ft_identificador_projeto_externo' => 'Representante de OSC',
        'ft_municipio' => 'Representante de OSC',
        'ft_uf' => 'Representante de OSC'
    ];

    public $timestamps = false;

    protected $with = [
        'dc_abrangencia_projeto',
        'dc_zona_atuacao_projeto',
        'dc_status_projeto',
        'fontes_recursos_projeto',
        'tipo_parcerias_projeto'
    ];

   //-----------------------------------------METODOS---------------------------------------//

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dc_abrangencia_projeto()
    {
        return $this->belongsTo('App\Models\Syst\DCAbrangenciaProjeto', 'cd_abrangencia_projeto', 'cd_abrangencia_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dc_zona_atuacao_projeto()
    {
        return $this->belongsTo('App\Models\Syst\DCZonaAtuacaoProjeto', 'cd_zona_atuacao_projeto', 'cd_zona_atuacao_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function municipio()
    {
        return $this->belongsTo('App\Models\Spat\Municipio', 'cd_municipio', 'edmu_cd_municipio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dc_status_projeto()
    {
        return $this->belongsTo('App\Models\Syst\DCStatusProjeto', 'cd_status_projeto', 'cd_status_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function uf()
    {
        return $this->belongsTo('App\Models\Spat\Uf', 'cd_uf', 'eduf_cd_uf');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function osc()
    {
        return $this->belongsTo('App\Models\Osc\Osc', 'id_osc', 'id_osc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fontes_recursos_projeto()
    {
        return $this->hasMany('App\Models\Osc\FonteRecursosProjeto', 'id_projeto', 'id_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tipo_parcerias_projeto()
    {
        return $this->hasMany('App\Models\Osc\TipoParceriaProjeto', 'id_projeto', 'id_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function localizacao_projeto()
    {
        return $this->hasMany('App\Models\Osc\LocalizacaoProjeto', 'id_projeto', 'id_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function financiadores_projeto()
    {
        return $this->hasMany('App\Models\Osc\FinanciadorProjeto', 'id_projeto', 'id_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function AreaAtuacaoOutraProjetos()
    {
        return $this->hasMany('App\Models\Osc\AreaAtuacaoOutraProjeto', 'id_projeto', 'id_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function AreaAtuacaoProjetos()
    {
        return $this->hasMany('App\Models\Osc\AreaAtuacaoProjeto', 'id_projeto', 'id_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function PublicoBeneficiadoProjetos()
    {
        return $this->hasMany('App\Models\Osc\PublicoBeneficiadoProjeto', 'id_projeto', 'id_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ObjetivoProjetos()
    {
        return $this->hasMany('App\Models\Osc\ObjetivoProjeto', 'id_projeto', 'id_projeto');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function OscParceiraProjetos()
    {
        return $this->hasMany('App\Models\Osc\OscParceiraProjeto', 'id_projeto', 'id_projeto');
    }
}
