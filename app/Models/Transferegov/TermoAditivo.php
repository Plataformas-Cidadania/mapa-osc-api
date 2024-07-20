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

 class TermoAditivo extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_termo_aditivo';

    /**
     * The primary key for the model.n
     * 
     * @var string
     */
    protected $primaryKey = 'numero_ta';
    
    public $timestamps = true;
    
    /**
     * @var array
     */
    protected $fillable = ['nr_convenio','id_solicitacao','numero_ta','tipo_ta','vl_global_ta','vl_repasse_ta','vl_contrapartida_ta','dt_assinatura_ta','dt_inicio_ta','dt_fim_ta','justificativa_ta'];

}
