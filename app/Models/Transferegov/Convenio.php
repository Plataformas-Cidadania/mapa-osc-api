<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int $seq_programa
  * @property string $id_programa
  * @property string $cod_orgao_sup_programa
  * @property string $desc_orgao_sup_programa
  * @property string $cod_programa
  * @property string $nome_programa
  * @property string $sit_programa
  * @property string $data_disponibilizacao
  * @property string $ano_disponibilizacao
  * @property string $dt_prog_ini_receb_prop
  * @property string $dt_prog_fim_receb_prop
  * @property string $dt_prog_ini_emenda_par
  * @property string $dt_prog_fim_emenda_par
  * @property string $dt_prog_ini_benef_esp
  * @property string $dt_prog_fim_benef_esp
  * @property string $modalidade_programa
  * @property string $natureza_juridica_programa
  * @property string $uf_programa
  * @property string $acao_orcamentaria
  * @property string $nome_subtipo_programa
  * @property string $descricao_subtipo_programa
 */

 class Convenio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_convenio';

    /**
     * The primary key for the model.n
     * 
     * @var string
     */
    protected $primaryKey = 'nr_convenio';
    
    public $timestamps = true;
    
    /**
     * @var array
     */
    protected $fillable = ['nr_convenio','id_proposta','nr_processo','dia_assin_conv','dia','mes','ano','sit_convenio','subsituacao_conv','situacao_publicacao','instrumento_ativo','ind_opera_obtv','ug_emitente','dia_publ_conv','dia_inic_vigenc_conv','dia_fim_vigenc_conv','dia_fim_vigenc_original_conv','dias_prest_contas','dia_limite_prest_contas','data_suspensiva','data_retirada_suspensiva','dias_clausula_suspensiva','situacao_contratacao','ind_assinado','motivo_suspensao','ind_foto','qtde_convenios','qtd_ta','qtd_prorroga','vl_global_conv','vl_repasse_conv','vl_contrapartida_conv','vl_empenhado_conv','vl_desembolsado_conv','vl_saldo_reman_tesouro','vl_saldo_reman_convenente','vl_rendimento_aplicacao','vl_ingresso_contrapartida','vl_saldo_conta','valor_global_original_conv'];

}
