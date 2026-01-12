<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int nr_convenio
  * @property int id_solicitacao
  * @property string numero_ta
  * @property string tipo_ta
  * @property double vl_global_ta
  * @property double vl_repasse_ta
  * @property double vl_contrapartida_ta
  * @property date dt_assinatura_ta
  * @property date dt_inicio_ta
  * @property date dt_fim_ta
  * @property string justificativa_ta
 */

 class Prorroga extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_prorroga';

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
    protected $fillable = ['nr_convenio','nr_prorroga','dt_inicio_prorroga','dt_fim_prorroga','dias_prorroga','dt_assinatura_prorroga','sit_prorroga'];

}
