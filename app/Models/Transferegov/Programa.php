<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int $id_programa
  * @property int $cod_orgao_sup_programa
  * @property string $desc_orgao_sup_programa
  * @property int $cod_programa
  * @property string $nome_programa
  * @property string $sit_programa
  * @property date $data_disponibilizacao
  * @property date $ano_disponibilizacao
  * @property date $dt_prog_ini_receb_prop
  * @property date $dt_prog_fim_receb_prop
  * @property date $dt_prog_ini_emenda_par
  * @property date $dt_prog_fim_emenda_par
  * @property date $dt_prog_ini_benef_esp
  * @property date $dt_prog_fim_benef_esp
  * @property string $modalidade_programa
  * @property string $natureza_juridica_programa
  * @property char(2) $uf_programa
  * @property string $acao_orcamentaria
  * @property string $nome_subtipo_programa
  * @property string $descricao_subtipo_programa
 */

 class Programa extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_programa';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_programa';

    /**
     * @var array
     */
    protected $fillable = ['id_programa','cod_orgao_sup_programa','desc_orgao_sup_programa','cod_programa','nome_programa','sit_programa','data_disponibilizacao','ano_disponibilizacao','dt_prog_ini_receb_prop','dt_prog_fim_receb_prop','dt_prog_ini_emenda_par','dt_prog_fim_emenda_par','dt_prog_ini_benef_esp','dt_prog_fim_benef_esp','modalidade_programa','natureza_juridica_programa','uf_programa','acao_orcamentaria','nome_subtipo_programa','descricao_subtipo_programa'];
    
    public $timestamps = true;
}
