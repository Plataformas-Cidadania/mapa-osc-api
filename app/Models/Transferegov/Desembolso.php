<?php

namespace App\Models\Transferegov;

use Illuminate\Database\Eloquent\Model;

/**
  * @property int id_desembolso
  * @property int nr_convenio
  * @property string dt_ult_desembolso
  * @property int qtd_dias_sem_desembolso
  * @property string data_desembolso
  * @property int ano_desembolso
  * @property int mes_desembolso
  * @property string nr_siafi
  * @property int ug_emitente_dh
  * @property string observacao_dh
  * @property int vl_desembolsado
 */

 class Desembolso extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transferegov.tb_desembolso';

    /**
     * The primary key for the model.n
     * 
     * @var string
     */
    protected $primaryKey = 'id_desembolso';
    
    public $timestamps = true;
    
    /**
     * @var array
     */
    protected $fillable = ['id_desembolso','nr_convenio','dt_ult_desembolso','qtd_dias_sem_desembolso','data_desembolso','ano_desembolso','mes_desembolso','nr_siafi','ug_emitente_dh','observacao_dh','vl_desembolsado'];

}
